<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PengeluaranBarangController extends Controller
{
    public function index (Request $request) {
        return view ('pengeluaran-barang.index');
    }

    public function store (Request $request) {
        if(empty($request->produk)) {
            toast()->error('Tidak ada produk yang dipilih');
            return redirect()->back();
        }
        dd($request->all());
    }
}