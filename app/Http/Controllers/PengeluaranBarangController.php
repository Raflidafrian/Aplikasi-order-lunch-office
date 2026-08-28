<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PengeluaranBarangController extends Controller
{
    public function index (Request $request) {
        return view ('pengeluaran-barang.index');
    }
}