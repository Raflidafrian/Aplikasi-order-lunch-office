<?php

namespace App\Http\Controllers;

use App\Models\ItemPenerimaanBarang;
use Illuminate\Http\Request;
use App\Models\PenerimaanBarang;
use Illuminate\Support\Facades\Auth;
use App\Models\Product;

class PenerimaanBarangController extends Controller
{
    public function index(Request $request)
    {
        return view('penerimaan-barang.index');
    }

    public function store(Request $request)
    {
        $request->validate([
        'distributor'                   => 'required',
        'nomor_faktur'                  => 'required',
        'produk'                        => 'required',
        ],
        [
            'distributor.required'       => 'Distributor harus diisi',
            'nomor_faktur.required'     => 'Nomor faktur harus diisi',
            'produk.required'           => 'Produk harus diisi',
        ]);

        $newData = PenerimaanBarang::create([
            'nomor_penerimaan'  => PenerimaanBarang::nomorPenerimaan(),
            'distributor'       => $request->distributor,
            'nomor_faktur'      => $request->nomor_faktur,
            'petugas_penerima'  => Auth::user()->name,
        ]);

        $produk = $request->produk;

        foreach ($produk as $item) {
            ItemPenerimaanBarang::create([
                'nomor_penerimaan'      => $newData->nomor_penerimaan,
                'nama_produk'           => $item['nama_produk'],
                'qty'                   => $item["qty"],
                'harga_beli'            => $item['harga_beli'],
                'sub_total'             => $item['sub_total'],
            ]);

            Product::where('id', $item['produk_id'])->increment('stok', $item['qty']);
        }

        toast()->success('Data berhasil ditambahkan');

        return redirect()->route('penerimaan-barang.index');
    }
}