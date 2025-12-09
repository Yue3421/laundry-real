@extends('layouts.app')

@section('title', 'Detail Transaksi: {{ $transaksi->kode_invoice }}')

@section('content')
<h1>Detail Transaksi: {{ $transaksi->kode_invoice }}</h1>

<div class="card mb-4">
    <div class="card-header bg-primary text-white">
        <strong>Informasi Umum</strong>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-md-6">
                <p><strong>Pelanggan:</strong> {{ $transaksi->member->nama }} ({{ $transaksi->member->tlp }})</p>
                <p><strong>Outlet:</strong> {{ $transaksi->outlet->nama }}</p>
                <p><strong>Petugas:</strong> {{ $transaksi->user->nama }} ({{ $transaksi->user->role }})</p>
            </div>
            <div class="col-md-6">
                <p><strong>Tanggal Masuk:</strong> {{ $transaksi->tgl->format('d-m-Y H:i') }}</p>
                <p><strong>Batas Waktu:</strong> {{ $transaksi->batas_waktu->format('d-m-Y H:i') }}</p>
                <p><strong>Tanggal Bayar:</strong> {{ $transaksi->tgl_bayar ? $transaksi->tgl_bayar->format('d-m-Y H:i') : 'Belum Dibayar' }}</p>
            </div>
        </div>
        <div class="row">
            <div class="col-md-4">
                <p><strong>Biaya Tambahan:</strong> Rp {{ number_format($transaksi->biaya_tambahan, 0, ',', '.') }}</p>
            </div>
            <div class="col-md-4">
                <p><strong>Diskon:</strong> {{ $transaksi->diskon }}%</p>
            </div>
            <div class="col-md-4">
                <p><strong>Pajak:</strong> Rp {{ number_format($transaksi->pajak, 0, ',', '.') }}</p>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <p><strong>Status:</strong> <span class="badge {{ $transaksi->status == 'baru' ? 'bg-warning' : ($transaksi->status == 'proses' ? 'bg-info' : ($transaksi->status == 'selesai' ? 'bg-success' : 'bg-primary')) }}">{{ ucfirst($transaksi->status) }}</span></p>
            </div>
            <div class="col-md-6">
                <p><strong>Pembayaran:</strong> <span class="badge {{ $transaksi->dibayar == 'dibayar' ? 'bg-success' : 'bg-danger' }}">{{ ucfirst(str_replace('_', ' ', $transaksi->dibayar)) }}</span></p>
            </div>
        </div>
    </div>
</div>

<div class="card mb-4">
    <div class="card-header bg-secondary text-white">
        <strong>Detail Paket Cucian</strong>
    </div>
    <div class="card-body">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Paket</th>
                    <th>Jenis</th>
                    <th>Qty</th>
                    <th>Harga per Unit</th>
                    <th>Subtotal</th>
                    <th>Keterangan</th>
                </tr>
            </thead>
            <tbody>
                @foreach($transaksi->detailTransaksis as $detail)
                    <tr>
                        <td>{{ $detail->paket->nama_paket }}</td>
                        <td>{{ ucfirst($detail->paket->jenis) }}</td>
                        <td>{{ $detail->qty }}</td>
                        <td>Rp {{ number_format($detail->paket->harga, 0, ',', '.') }}</td>
                        <td>Rp {{ number_format($detail->qty * $detail->paket->harga, 0, ',', '.') }}</td>
                        <td>{{ $detail->keterangan ?? '-' }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        @if($transaksi->detailTransaksis->isEmpty())
            <p class="text-center">Belum ada detail paket.</p>
        @endif
    </div>
    <div class="card-footer">
        <strong>Total Keseluruhan:</strong> Rp {{ number_format(($transaksi->detailTransaksis->sum(fn($d) => $d->qty * $d->paket->harga) + $transaksi->biaya_tambahan + $transaksi->pajak) - ($transaksi->diskon / 100 * $transaksi->detailTransaksis->sum(fn($d) => $d->qty * $d->paket->harga)), 0, ',', '.') }}
    </div>
</div>

<a href="{{ route('transaksis.index') }}" class="btn btn-secondary">Kembali ke Daftar Transaksi</a>
@if(in_array(auth()->user()->role, ['admin', 'kasir']))
    <a href="{{ route('transaksis.edit', $transaksi) }}" class="btn btn-warning">Edit Transaksi</a>
@endif
@endsection