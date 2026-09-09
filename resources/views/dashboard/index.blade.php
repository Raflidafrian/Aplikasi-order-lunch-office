@extends('layouts.app')
@section('content_title', 'Dashboard')
@section('content')
<div class="row">
    <x-dashboard-card type="bg-info" icon="fas fa-users" label="Total User" value="{{ $totalUser }}"/>
    <x-dashboard-card type="bg-success" icon="fas fa-suitcase" label="Total Produk" value="{{ $totalProduk }}"/>
    <x-dashboard-card type="bg-warning" icon="fas fa-shopping-bag" label="Total Order" value="{{ $totalOrder }}"/>
    <x-dashboard-card type="bg-danger" icon="fas fa-dollar-sign" label="Total Pendapatan" value="{{ $totalPendapatan }}"/>
</div>
<div class="row">
    <div class="col-6">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Transaksi Terakhir</h4>
            </div>
            <div class="card-body">
                <table class="table table-sm">
                    <thead>
                        <tr>
                            <th>Tanggal Transaksi</th>
                            <th>Nomor Transaksi</th>
                            <th>Jumlah Item</th>
                            <th>Total Harga</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($latestOrders as $item)
                        <tr>
                            <td>{{ $item->tanggal_transaksi }}</td>
                            <td>{{ $item->nomor_pengeluaran }}</td>
                            <td>{{ $item->items->count() }} <small>Item</small></td>
                            <td>Rp. {{ number_format($item->total_harga) }}</td>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="card-footer">
                Menampilkan 5 Data Transaksi Terbaru
            </div>
        </div>
    </div>
</div>
@endsection