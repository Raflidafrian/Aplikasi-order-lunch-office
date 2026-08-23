<?php

namespace App\Http\Controllers;

use App\Models\ItemPenerimaanBarang;
use Illuminate\Http\Request;
use App\Models\PenerimaanBarang;
use Illuminate\Support\Facades\Auth;

class PenerimaanBarangController extends Controller
{
    public function index(Request $request)
    {
        return view('penerimaan-barang.index');
    }

    public function store(Request $request)
    {
        dd($request->all());
        $request->validate([
        'distributor'                   => 'required',
        'nomor_faktur'                  => 'required',
        'produk'                        => 'required',
        ],
        [
            'distirbuto.required'       => 'Distributor harus diisi',
            'nomor_faktur.required'     => 'Nomor faktur harus diisi',
            'produk.required'           => 'Produk harus diisi',
        ]);

        $newData = PenerimaanBarang::create([
            'nomor_penerimaan'  => PenerimaanBarang::nomorPenerimaan(),
            'distirbutor'       => $request->distirbutor,
            'nomor_faktur'      => $request->nomor_faktur,
            'petugas_penerima'  => Auth::user()->name,
        ]);

        $produk = $request->produk;

        foreach ($produk as $item) {
            ItemPenerimaanBarang::create([
                'nomor_penerimaan'      => $newData->nomor_penerimaan,
                'nama_produk'           => $item['nama_produk'],
                'qty'                   => $item["qty"],
            ]);
        }

        toast()->success('Data berhasil ditambahkan');



        dd($request->all());
    }
}