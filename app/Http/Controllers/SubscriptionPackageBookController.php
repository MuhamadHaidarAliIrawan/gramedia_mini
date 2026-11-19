<?php

namespace App\Http\Controllers;

use App\Models\SubscriptionPackageBook;
use App\Models\SubscriptionPackage;
use App\Models\Book;
use App\Models\BookCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\Facades\DataTables;

class SubscriptionPackageBookController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request, $packageId)
    {
          if ($request->ajax()) {
            $books = Book::with('bookCategory');

            return DataTables::of($books)
                ->addIndexColumn()

                ->editColumn('cover', function ($row) {
                    if ($row->cover) {
                
                        return '<img src="' . asset($row->cover) .
                            '" alt="' . e($row->title) .
                            '" class="img-thumbnail" style="max-height: 60px;">';
                    }

                    return '<span class="badge bg-secondary">No Cover</span>';
                })

                ->editColumn('price', function ($row) {
                    return 'Rp ' . number_format($row->price, 0, ',', '.');
                })

                ->addColumn('category_name', function ($row) {
                    return $row->bookCategory
                        ? $row->bookCategory->name
                        : '-';
                })
                //untuk mengecek apakah buku sudah ditambahkan ke paket langganan yg lagi dipilih
                ->addColumn('checkBook', function($row)use($packageId){
                    //ambil book_id dari package_bookyg package_id nya sesuai yg lagi dipilih
                    $bookIds = SubscriptionPackageBook::where('subscription_package_id', $packageId)->pluck('book_id')
                    ->toArray();
                    //pluck : mengambil data hanya dari 1 attribute yang dipanggil
                    //Awalnya di SubscriptionPackageBook ada package_id sama book_id,
                    //yang akan diambil datanya ahanya book_id, data disimpan ke array
                    //dengan toArray()
                    return in_array($row->id, $bookIds) ? true : false;
                    //jika $row->id (id buku) ada array $bookIds (yg isinya
                    //daftar book_id dari db package_book), maka kembalikan nilai
                    //true, jika tidak ada kembalikan nilai false
                })

                ->rawColumns(['cover'])
                ->make(true);
        }
        $subscriptionPackage = SubscriptionPackage::find($packageId);
        return view('admin.subscription-package-books.index', compact('subscriptionPackage'));
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
    public function store(Request $request, $packageId)
    {
        $request->validate([
            //memastikan name="bookIds[]" ada isinya
            'bookIds' => 'required'
        ]);

        foreach ($request->bookIds as $key => $value){
            //simpan data sebanyak jumlah yang di array
            SubscriptionPackageBook::create([
                //bookIds isinya [2,3] id yang dipilih, $value isinya satu satu (2 atau 3 sesuai yg di loop)
                'book_id' => $value,
                'subscription_package_id' => $packageId,
            ]);
        }

        //['packageId' => $packageId] : mengirim ke web.php {packageId} berupa id paket yang sebelumnya dipilih
        return redirect()
        ->route('admin.subscription-package-books', ['packageId' => $packageId])
        ->with('success', "Berhasil menambahkan buku ke paket langganan!"); 
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request, $packageId)
    {
        $subscriptionPackage = SubscriptionPackage::findOrFail($packageId);

        $search = $request->input('search') ?? $request->input('q');

        // Mengambil data dari table subscription_package_books berdasarkan subscription_package_id
        // Menggunakan eloquent with() untuk mengambil detail data books
        $query = SubscriptionPackageBook::where('subscription_package_id', $subscriptionPackage->id)
            ->with(['book.bookCategory', 'subscriptionPackage']);

        // Sediakan search bar yang dapat mencari data buku berdasarkan judulnya pada paket langganan tersebut
        if (!empty($search)) {
            $query->whereHas('book', function ($q) use ($search) {
                $q->where('title', 'like', '%' . $search . '%');
            });
        }

        $subscriptionPackageBooks = $query->get();
        $totalPackageBooks = SubscriptionPackageBook::where('subscription_package_id', $subscriptionPackage->id)->count();

        return view('subscription', compact(
            'subscriptionPackage',
            'subscriptionPackageBooks',
            'search',
            'totalPackageBooks'
        ));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(SubscriptionPackageBook $subscriptionPackageBook)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, SubscriptionPackageBook $subscriptionPackageBook)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(SubscriptionPackageBook $subscriptionPackageBook)
    {
        //
    }
    
}