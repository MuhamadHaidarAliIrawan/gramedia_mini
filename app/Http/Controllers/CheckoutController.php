<?php

namespace App\Http\Controllers;

use App\Models\Checkout;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Cart;
use Illuminate\Support\Facades\DB;
use App\Models\CheckoutBook;
use App\Services\Midtrans\CreateSnapTokenService;
use App\Services\Midtrans\CallbackService;

class CheckoutController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //dd($request->all());
        $request->validate([
            // selected_carts berjenis array min 1 item yg dipilih
            'selected_carts' => ['required', 'array', 'min:1'],
            // .* validasi isi array, pastikan isinya berupa id dari table carts
            'selected_carts.*' => ['exists:carts,id'],
        ]);

        $selectedCarts = Cart::class::where('user_id', Auth::user()->id)
            // whereIn : mencari data dari array, where : mencari data dari string/int
            ->whereIn('id', $request->selected_carts)
            ->with(['book', 'subscriptionPackage'])->get();

        if ($selectedCarts->isEmpty()) {
            return redirect()->back()->with('error', 'Buku tidak ada di keranjang Anda!');
        }

        // membuat array harga item keranjang
        // ['11' => 8000, '12' => 9000] : item 1 harga 8000, item 2 harga 9000
        $prices = $selectedCarts->mapWithKeys(
            fn($row) =>
                [
                    //harganya sesuai pilihan, beli seharga buku/paket langganan
                    $row->id => $row->subscription_package_id == NULL ?
                        $row->book->price : $row->subscriptionPackage->price
                ]
        );
        $totalPrice = $prices->sum();

        DB::beginTransaction();
        try {
            // 1. buat ada cheqout baru
            $checkout = Checkout::create([
                'user_id' => Auth::user()->id,
                'total_book_price' => $totalPrice,
                'total_price' => $totalPrice, // saat ini belum ada tambahan pengiriman
                'total_book' => $selectedCarts->count(),
                'status' => 'pending', // belum dibayar
                'order_code' => 'ORD-' . time(), // generate unik code order
            ]);
            // 2. simpan satu satu data yang di checkout
            foreach ($selectedCarts as $item) {
                CheckoutBook::create([
                    'book_id' => $item->book_id,
                    'subscription_package_id' => $item->subscription_package_id,
                    'price' => $prices[$item->id], // ammbil harga dari $prices yg id nya sama kaya id yang di looping
                    'checkout_id' => $checkout->id,
                ]);
            }
            // 3. hapus buku dari keranjang
            Cart::whereIn('id', $request->selected_carts)->delete();
            //jika berhasil ketiganya, sahkan perubahan di db 
            DB::commit();
            //panggil fungsi show dari routing untuk meminta dan mengambil snaptoken dari midtrans
            return redirect()->route('checkout.show', $checkout->id);
        } catch (\Throwable $th) {
            DB::rollBack(); // menarik perubahan (ctrl z), kalau adaerr di try
            dd($th); // cek detail erroe (HANYA DIGUNAKAN SEBELUM DI HOSTING)
            return redirect()->back()->with('error', 'Terjadi kesalahan saat checkout. Silahkan coba lagi!');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $checkout = Checkout::findOrFail($id);
        $snapToken = $checkout->snap_token;
        if (is_null($snapToken)) {
            // If snap token is still NULL, generate snap token and save it to database

            $midtrans = new CreateSnapTokenService($checkout);
            $snapToken = $midtrans->getSnapToken();

            $checkout->snap_token = $snapToken;
            $checkout->save();
        }

        return view('user.checkout.show', compact('checkout', 'snapToken'));
    }
    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Checkout $checkout)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Checkout $checkout)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Checkout $checkout)
    {
        //
    }

    public function receive()
    {
        $callback = new CallbackService;

        if ($callback->isSignatureKeyVerified()) {
            $checkout = $callback->getCheckout();

            if ($callback->isSuccess()) {
                $checkout->update([
                    'status' => 'paid',
                    'payment' => $callback->getPaymentType(),
                    'paid_date' => now(),
                ]);
            }

            if ($callback->isSuccess()) {
                $checkout->update([
                    'status' => 'expired',
                ]);
            }

            if ($callback->isCancelled()) {
                $checkout->update([
                    'status' => 'failed',
                ]);
            }

            return response()
                ->json([
                    'success' => true,
                    'message' => 'Notification successfully processed',
                ]);
        } else {
            return response()
                ->json([
                    'error' => true,
                    'message' => 'Signature key not verified',
                ], 403);
        }
    }
}
