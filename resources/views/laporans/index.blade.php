@extends('layouts.app')

@section('title', 'Generate Laporan')

@section('content')
<h1>Laporan Transaksi</h1>
<form method="GET">
    <div class="row mb-3">
        <div class="col-md-4">
            <input type="date" class="form-control" name="start_date" placeholder="Dari Tanggal">
        </div>
        <div class="col-md-4">
            <input type="date" class="form-control" name="end_date" placeholder="Sampai Tanggal">
        </div>
        <div class="col-md-4">
            <button type="submit" class="btn btn-primary">Filter</button>
        </div>
    </div>
</form>
<table class="table table-striped">
    <thead>
        <tr>
            <th>Kode Invoice</th>
            <th>Pelanggan</th>
            <th>Tanggal</th>
            <th>Total</th> <!-- Hitung dari detail -->
            <th>Status</th>
        </tr>
    </thead>
    <tbody>
        @foreach($transaksis as $transaksi)
            <tr>
                <td>{{ $transaksi->kode_invoice }}</td>
                <td>{{ $transaksi->member->nama }}</td>
                <td>{{ $transaksi->tgl }}</td>
                <td>Rp {{ $transaksi->detailTransaksis->sum(fn($d) => $d->qty * $d->paket->harga) }}</td>
                <td>{{ $transaksi->status }}</td>
            </tr>
        @endforeach
    </tbody>
</table>
@endsection