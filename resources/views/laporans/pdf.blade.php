<!DOCTYPE html>
<html>
<head>
    <title>Laporan Transaksi</title>
    <style>
        table { width: 100%; border-collapse: collapse; }
        th, td { border: 1px solid black; padding: 8px; text-align: left; }
        th { background-color: #f2f2f2; }
        .total { font-weight: bold; }
    </style>
</head>
<body>
    <h1>Laporan Transaksi Laundry</h1>
    <p>Tanggal: {{ request('start_date') ?? 'Semua' }} s/d {{ request('end_date') ?? 'Semua' }}</p>
    <table>
        <thead>
            <tr>
                <th>Kode Invoice</th>
                <th>Pelanggan</th>
                <th>Tanggal</th>
                <th>Total (Rp)</th>
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
                    <td>{{ ucfirst($transaksi->status) }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="5">Tidak ada data transaksi.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</body>
</html>