<?php

namespace App\Http\Controllers;

use App\Models\ItemPengeluaranBarang;



class DashboardController extends Controller
{
    public function index()
    {
        $bulanIni       = \Carbon\Carbon::now()->month;
        $tahunIni       = \Carbon\Carbon::now()->year;

        $totalUser = \App\Models\User::count();
        $totalProduk = \App\Models\Product::count();

        $totalOrder = \App\Models\PengeluaranBarang::whereMonth('created_at', $bulanIni)
            ->whereYear('created_at', $tahunIni)
            ->count();
        $totalPendapatan = \App\Models\PengeluaranBarang::whereMonth('created_at', $bulanIni)
            ->whereYear('created_at', $tahunIni)
            ->sum('total_harga') ?? 0;
        $totalPendapatan = "Rp." . number_format($totalPendapatan);

        $latestOrders = \App\Models\PengeluaranBarang::latest()->take(5)->get()->map(function($item) {
            $item->tanggal_transaksi = \Carbon\Carbon::parse($item->created_at)->locale('id')->translatedFormat('l,d-m-Y');
            return $item;
        });

        $produkTerlaris = ItemPengeluaranBarang::select('nama_produk')
        ->selectRaw('SUM(qty) as total_terjual')
        ->whereMonth('created_at', $bulanIni)
        ->whereYear('created_at', $tahunIni)
        ->groupBy('nama_produk')
        ->orderByDesc('total_terjual')
        ->limit(5)
        ->get();
        
        return view('dashboard.index', compact('totalUser', 'totalProduk', 'totalOrder', 'totalPendapatan', 'latestOrders', 'produkTerlaris'));
    }
}