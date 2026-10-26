<?php

namespace App\Http\Controllers;

use App\Models\SubscriptionPackage;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class SubscriptionPackageController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $model = SubscriptionPackage::query();

            return DataTables::eloquent($model)
                // Menambahkan penomoran otomatis (kolom 'DT_RowIndex')
                ->addIndexColumn()
                ->editColumn('color', function ($row) {
                    return '
                    <div class="d-flex align-items-center gap-2">
                        <span class="rounded-circle d-inline-block" style="width: 20px; height: 20px; background-color: '.e($row->color).'; border: 1px solid #dee2e6;"></span>
                        <span>'.e($row->color).'</span>
                    </div>
                ';
                })
                ->editColumn('price', function ($row) {
                    return 'Rp '.number_format($row->price, 0, ',', '.');
                })
                // Menambahkan kolom tombol Aksi (Edit & Hapus)
                ->addColumn('action', function ($row) {
                    $editUrl = route('admin.subscription-plans.edit', $row->id);
                    $destroyUrl = route('admin.subscription-plans.destroy', $row->id);
                    $csrf = csrf_field();
                    $method = method_field('DELETE');

                    return '
                    <a href="'.$editUrl.'" class="btn btn-sm btn-warning">Edit</a>
                    <form action="'.$destroyUrl.'" method="POST" class="d-inline">
                        '.$csrf.'
                        '.$method.'
                        <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm(\'Apakah Anda yakin ingin menghapus paket ini?\')">Hapus</button>
                    </form>
                ';
                })
                // Memberitahu Yajra bahwa kolom 'action' dan 'color' mengandung tag HTML
                ->rawColumns(['action', 'color'])
                ->toJson();
        }

        return view('admin.subscription-plans.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.subscription-plans.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name_package' => ['required', 'string', 'max:255'],
            'description' => ['required', 'string'],
            'color' => ['required', 'string', 'max:255'],
            'price' => ['required', 'integer', 'min:0'],
        ]);

        SubscriptionPackage::create($validatedData);

        return redirect()->route('admin.subscription-plans.index')->with('success', 'Paket langganan berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        // findOrFail : mencari data berdasarkan id, jika tidak ditemukan maka akan menampilkan error 404
        // atau bisa gunakan :
        // find : mencari data berdasarkan id, jika tidak ditemukan maka akan mengembalikan null
        $subscriptionPackage = SubscriptionPackage::findOrFail($id);

        return view('admin.subscription-plans.edit', compact('subscriptionPackage'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        // jika data id tidak ditemukan maka akan menampilkan error 404, hentikan proses dibawahnya
        $subscriptionPackage = SubscriptionPackage::findOrFail($id);

        $validatedData = $request->validate([
            'name_package' => ['required', 'string', 'max:255'],
            'description' => ['required', 'string'],
            'color' => ['required', 'string', 'max:255'],
            'price' => ['required', 'integer', 'min:0'],
        ]);

        $subscriptionPackage->update($validatedData);

        return redirect()->route('admin.subscription-plans.index')->with('success', 'Paket langganan berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        // jika data id tidak ditemukan maka akan menampilkan error 404, hentikan proses dibawahnya
        $subscriptionPackage = SubscriptionPackage::findOrFail($id);

        $subscriptionPackage->delete();

        return redirect()->route('admin.subscription-plans.index')->with('success', 'Paket langganan berhasil dihapus.');
    }
}
