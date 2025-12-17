@extends('layouts.app')

@section('title', 'Edit Transaksi')

@section('content')
<h1>Edit Transaksi: {{ $transaksi->kode_invoice }}</h1>
<form action="{{ route('transaksis.update', $transaksi) }}" method="POST">
    @csrf
    @method('PUT')
    <div class="row">
        <div class="col-md-6">
            <div class="mb-3">
                <label for="id_member" class="form-label">Pilih Pelanggan</label>
                <select class="form-select" id="id_member" name="id_member" required>
                    <option value="">-- Pilih Pelanggan --</option>
                    @foreach($members as $member)
                        <option value="{{ $member->id }}" {{ $transaksi->id_member == $member->id ? 'selected' : '' }}>{{ $member->nama }} ({{ $member->tlp }})</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="col-md-6">
            <div class="mb-3">
                <label for="kode_invoice" class="form-label">Kode Invoice</label>
                <input type="text" class="form-control" id="kode_invoice" name="kode_invoice" value="{{ $transaksi->kode_invoice }}" required>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <div class="mb-3">
                <label for="tgl" class="form-label">Tanggal Masuk</label>
                <input type="datetime-local" class="form-control" id="tgl" name="tgl" value="{{ $transaksi->tgl->format('Y-m-d\TH:i') }}" required>
            </div>
        </div>
        <div class="col-md-6">
            <div class="mb-3">
                <label for="batas_waktu" class="form-label">Batas Waktu</label>
                <input type="datetime-local" class="form-control" id="batas_waktu" name="batas_waktu" value="{{ $transaksi->batas_waktu->format('Y-m-d\TH:i') }}" required>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-4">
            <div class="mb-3">
                <label for="biaya_tambahan" class="form-label">Biaya Tambahan (Rp)</label>
                <input type="number" class="form-control" id="biaya_tambahan" name="biaya_tambahan" min="0" value="{{ $transaksi->biaya_tambahan }}">
            </div>
        </div>
        <div class="col-md-4">
            <div class="mb-3">
                <label for="diskon" class="form-label">Diskon (%)</label>
                <input type="number" class="form-control" id="diskon" name="diskon" min="0" max="100" value="{{ $transaksi->diskon }}">
            </div>
        </div>
        <div class="col-md-4">
            <div class="mb-3">
                <label for="pajak" class="form-label">Pajak (Rp)</label>
                <input type="number" class="form-control" id="pajak" name="pajak" min="0" value="{{ $transaksi->pajak }}">
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <div class="mb-3">
                <label for="status" class="form-label">Status</label>
                <select class="form-select" id="status" name="status" required>
                    <option value="baru" {{ $transaksi->status == 'baru' ? 'selected' : '' }}>Baru</option>
                    <option value="proses" {{ $transaksi->status == 'proses' ? 'selected' : '' }}>Proses</option>
                    <option value="selesai" {{ $transaksi->status == 'selesai' ? 'selected' : '' }}>Selesai</option>
                    <option value="diambil" {{ $transaksi->status == 'diambil' ? 'selected' : '' }}>Diambil</option>
                </select>
            </div>
        </div>
        <div class="col-md-6">
            <div class="mb-3">
                <label for="dibayar" class="form-label">Status Pembayaran</label>
                <select class="form-select" id="dibayar" name="dibayar" required>
                    <option value="belum_dibayar" {{ $transaksi->dibayar == 'belum_dibayar' ? 'selected' : '' }}>Belum Dibayar</option>
                    <option value="dibayar" {{ $transaksi->dibayar == 'dibayar' ? 'selected' : '' }}>Dibayar</option>
                </select>
            </div>
        </div>
    </div>

    <hr>
    <h4>Detail Paket Cucian</h4>
    <div id="details-container">
        @foreach($transaksi->detailTransaksis as $index => $detail)
            <div class="detail-row row mb-3">
                <div class="col-md-4">
                    <select class="form-select" name="details[{{ $index }}][id_paket]" required>
                        <option value="">-- Pilih Paket --</option>
                        @foreach($pakets as $paket)
                            <option value="{{ $paket->id }}" {{ $detail->id_paket == $paket->id ? 'selected' : '' }}>{{ $paket->nama_paket }} ({{ $paket->jenis }} - Rp {{ number_format($paket->harga, 0, ',', '.') }})</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-3">
                    <input type="number" class="form-control" name="details[{{ $index }}][qty]" placeholder="Qty (kg/buah)" step="0.1" min="0.1" value="{{ $detail->qty }}" required>
                </div>
                <div class="col-md-4">
                    <textarea class="form-control" name="details[{{ $index }}][keterangan]" placeholder="Keterangan (opsional)">{{ $detail->keterangan }}</textarea>
                </div>
                <div class="col-md-1">
                    <button type="button" class="btn btn-danger remove-row" {{ $index == 0 ? 'style="display:none;"' : '' }}><i class="bi bi-trash"></i></button>
                </div>
            </div>
        @endforeach
    </div>
    <button type="button" class="btn btn-primary mb-3 mt-3" id="add-detail">Tambah Paket Lain</button>

    <button type="submit" class="btn btn-warning">Update Transaksi</button>
    <a href="{{ route('transaksis.index') }}" class="btn btn-secondary">Batal</a>
</form>

<script>
    let detailCount = {{ $transaksi->detailTransaksis->count() }};
    document.getElementById('add-detail').addEventListener('click', function() {
        const container = document.getElementById('details-container');
        const newRow = document.createElement('div');
        newRow.className = 'detail-row row mb-3';
        newRow.innerHTML = `
            <div class="col-md-4">
                <select class="form-select" name="details[${detailCount}][id_paket]" required>
                    <option value="">-- Pilih Paket --</option>
                    @foreach($pakets as $paket)
                        <option value="{{ $paket->id }}">{{ $paket->nama_paket }} ({{ $paket->jenis }} - Rp {{ number_format($paket->harga, 0, ',', '.') }})</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-3">
                <input type="number" class="form-control" name="details[${detailCount}][qty]" placeholder="Qty (kg/buah)" step="0.1" min="0.1" required>
            </div>
            <div class="col-md-4">
                <textarea class="form-control" name="details[${detailCount}][keterangan]" placeholder="Keterangan (opsional)"></textarea>
            </div>
            <div class="col-md-1">
                <button type="button" class="btn btn-danger remove-row"><i class="bi bi-trash"></i></button>
            </div>
        `;
        container.appendChild(newRow);
        detailCount++;

        newRow.querySelector('.remove-row').addEventListener('click', function() {
            newRow.remove();
        });
    });

    document.addEventListener('click', function(e) {
        if (e.target.classList.contains('remove-row')) {
            e.target.closest('.detail-row').remove();
        }
    });
</script>
@endsection