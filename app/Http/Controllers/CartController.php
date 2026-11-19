<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $carts = Cart::where('user_id', Auth::user()->id)->with('book')->get();
        return view('user.books.cart', compact('carts'));
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
        //ngecek data apa aja yg dikirim blade ke controller
        // dd($request->all());

        if (!$request->purchase_option) {
            return redirect()->back()->with('error', 'Pastikan untuk memilih 
            jenis harga pembayaran');
        }

        //kurung [] yg pertama : menjadi acuan kapan di updatenya
        //kurung [] yg kedua : apa yang ingin di updatenya

        if ($request->action == "add_to_cart") {
            Cart::updateOrCreate([
                'user_id' => Auth::user()->id,
                'book_id' => $request->book_id
            ], [
                //jika purchase_option "none" (harga satuan) relasi ke paket langganan dikosongkan
                'subscription_package_id' => $request->purchase_option == "none" ? null : $request->purchase_option
            ]);
            return redirect()->back()->with('success', 'Buku berhasil ditambahkan ke keranjang Anda!');
        } else {
            dd('proses beli sekarang');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Cart $cart)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Cart $cart)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Cart $cart)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Cart $cart, $id)
    {
        Cart::where('id', $id)->where('user_id', Auth::id())->delete();
        return redirect()->route('cart')->with('success', 'Buku Berhasil Di Hapus Dari Keranjang');
    }
}
