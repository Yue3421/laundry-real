@extends('layouts.app')

@section('title', 'Generate Laporan')

@section('content')
<h1>Laporan Transaksi</h1>
<form method="GET">
    <div class="row mb-3">
        <div class="col-md-4">
            <input type="date" class="form-control" name="start_date" value="{{ request('start_date') }}" placeholder="Dari Tanggal">
        </div>
        <div class="col-md-4">
            <input type="date" class="form-control" name="end_date" value="{{ request('end_date') }}" placeholder="Sampai Tanggal">
        </div>
        <div class="col-md-4">
            <button type="submit" class="btn btn-primary">Filter</button>
            <a href="{{ route('laporans.index') }}" class="btn btn-secondary">Reset Filter</a>
        </div>
    </div>
</form>
<table class="table table-striped">
    <thead>
        <tr>
            <th>Kode Invoice</th>
            <th>Pelanggan</th>
            <th>Tanggal</th>
            <th>Total (Rp)</th> <!-- Hitung lengkap: subtotal detail + tambahan + pajak - diskon -->
            <th>Status</th>
        </tr>
    </thead>
    <tbody>
        @forelse($transaksis as $transaksi)
            <tr>
                <td>{{ $transaksi->kode_invoice }}</td>
                <td>{{ $transaksi->member->nama }}</td>
                <td>{{ $transaksi->tgl->format('d-m-Y H:i') }}</td>
                <td>
                    @php
                        $subtotal = $transaksi->detailTransaksis->sum(fn($d) => $d->qty * $d->paket->harga);
                        $diskonAmount = ($transaksi->diskon / 100) * $subtotal;
                        $total = $subtotal + $transaksi->biaya_tambahan + $transaksi->pajak - $diskonAmount;
                    @endphp
                    Rp {{ number_format($total, 0, ',', '.') }}
                </td>
                <td>
                    <span class="badge {{ $transaksi->status == 'baru' ? 'bg-warning' : ($transaksi->status == 'proses' ? 'bg-info' : ($transaksi->status == 'selesai' ? 'bg-success' : 'bg-primary')) }}">
                        {{ ucfirst($transaksi->status) }}
                    </span>
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="5" class="text-center text-muted">Tidak ada transaksi dalam rentang waktu ini. Coba ubah filter atau tambah transaksi baru.</td>
            </tr>
        @endforelse
    </tbody>
</table>
@endsection