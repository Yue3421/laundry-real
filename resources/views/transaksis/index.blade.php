@extends('layouts.app')

@section('title', 'Daftar Transaksi')

@section('content')
<h1>Daftar Transaksi</h1>
@if(in_array(auth()->user()->role, ['admin', 'kasir']))
    <a href="{{ route('transaksis.create') }}" class="btn btn-primary mb-3"><i class="bi bi-plus"></i> Tambah Transaksi</a>
@endif
<table class="table table-striped">
    <thead>
        <tr>
            <th>ID</th>
            <th>Kode Invoice</th>
            <th>Pelanggan</th>
            <th>Tanggal Masuk</th>
            <th>Batas Waktu</th>
            <th>Status</th>
            <th>Dibayar</th>
            <th>Total (Rp)</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        @foreach($transaksis as $transaksi)
            <tr>
                <td>{{ $transaksi->id }}</td>
                <td>{{ $transaksi->kode_invoice }}</td>
                <td>{{ $transaksi->member->nama }}</td>
                <td>{{ $transaksi->tgl->format('d-m-Y H:i') }}</td>
                <td>{{ $transaksi->batas_waktu->format('d-m-Y H:i') }}</td>
                <td>
                    <span class="badge {{ $transaksi->status == 'baru' ? 'bg-warning' : ($transaksi->status == 'proses' ? 'bg-info' : ($transaksi->status == 'selesai' ? 'bg-success' : 'bg-primary')) }}">
                        {{ ucfirst($transaksi->status) }}
                    </span>
                </td>
                <td>
                    <span class="badge {{ $transaksi->dibayar == 'dibayar' ? 'bg-success' : 'bg-danger' }}">
                        {{ ucfirst(str_replace('_', ' ', $transaksi->dibayar)) }}
                    </span>
                </td>
                <td>{{ number_format($transaksi->detailTransaksis->sum(fn($detail) => $detail->qty * $detail->paket->harga) + $transaksi->biaya_tambahan + $transaksi->pajak - ($transaksi->diskon / 100 * $transaksi->detailTransaksis->sum(fn($detail) => $detail->qty * $detail->paket->harga)), 0, ',', '.') }}</td>
                <td>
                    <a href="{{ route('transaksis.show', $transaksi) }}" class="btn btn-info btn-sm"><i class="bi bi-eye"></i> Detail</a>
                    @if(in_array(auth()->user()->role, ['admin', 'kasir']))
                        <a href="{{ route('transaksis.edit', $transaksi) }}" class="btn btn-warning btn-sm"><i class="bi bi-pencil"></i> Edit</a>
                        <form action="{{ route('transaksis.destroy', $transaksi) }}" method="POST" style="display:inline;">
                            @csrf @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Yakin hapus transaksi ini?')"><i class="bi bi-trash"></i> Hapus</button>
                        </form>
                    @endif
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
@if($transaksis->isEmpty())
    <p class="text-center">Belum ada transaksi.</p>
@endif
@endsection