@extends('layouts.app')

@section('title', 'Entri Transaksi Baru')

@section('content')
<h1>Tambahkan Transaksi Baru</h1>
<form action="{{ route('transaksis.store') }}" method="POST">
    @csrf
    <div class="row">
        <div class="col-md-6">
            <div class="mb-3">
                <label for="id_member" class="form-label">Pilih Pelanggan</label>
                <select class="form-select" id="id_member" name="id_member" required>
                    <option value="">-- Pilih Pelanggan --</option>
                    @foreach($members as $member)
                        <option value="{{ $member->id }}">{{ $member->nama }} ({{ $member->tlp }})</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="col-md-6">
            <div class="mb-3">
                <label for="kode_invoice" class="form-label">Kode Invoice (Auto Generate)</label>
                <input type="text" class="form-control" id="kode_invoice" disabled value="Akan digenerate otomatis">
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <div class="mb-3">
                <label for="tgl" class="form-label">Tanggal Masuk</label>
                <input type="datetime-local" class="form-control" id="tgl" name="tgl" required>
            </div>
        </div>
        <div class="col-md-6">
            <div class="mb-3">
                <label for="batas_waktu" class="form-label">Batas Waktu</label>
                <input type="datetime-local" class="form-control" id="batas_waktu" name="batas_waktu" required>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-4">
            <div class="mb-3">
                <label for="biaya_tambahan" class="form-label">Biaya Tambahan (Rp)</label>
                <input type="number" class="form-control" id="biaya_tambahan" name="biaya_tambahan" min="0" value="0">
            </div>
        </div>
        <div class="col-md-4">
            <div class="mb-3">
                <label for="diskon" class="form-label">Diskon (%)</label>
                <input type="number" class="form-control" id="diskon" name="diskon" min="0" max="100" value="0">
            </div>
        </div>
        <div class="col-md-4">
            <div class="mb-3">
                <label for="pajak" class="form-label">Pajak (Rp)</label>
                <input type="number" class="form-control" id="pajak" name="pajak" min="0" value="0">
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <div class="mb-3">
                <label for="status" class="form-label">Status</label>
                <select class="form-select" id="status" name="status" required>
                    <option value="baru">Baru</option>
                    <option value="proses">Proses</option>
                    <option value="selesai">Selesai</option>
                    <option value="diambil">Diambil</option>
                </select>
            </div>
        </div>
        <div class="col-md-6">
            <div class="mb-3">
                <label for="dibayar" class="form-label">Status Pembayaran</label>
                <select class="form-select" id="dibayar" name="dibayar" required>
                    <option value="belum_dibayar">Belum Dibayar</option>
                    <option value="dibayar">Dibayar</option>
                </select>
            </div>
        </div>
    </div>

    <hr>
    <h4>Detail Paket Cucian</h4>
    <div id="details-container">
        <div class="detail-row row mb-3">
            <div class="col-md-4">
                <select class="form-select" name="details[0][id_paket]" required>
                    <option value="">-- Pilih Paket --</option>
                    @foreach($pakets as $paket)
                        <option value="{{ $paket->id }}">{{ $paket->nama_paket }} ({{ $paket->jenis }} - Rp {{ number_format($paket->harga, 0, ',', '.') }})</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-3">
                <input type="number" class="form-control" name="details[0][qty]" placeholder="Qty (kg/buah)" step="0.1" min="0.1" required>
            </div>
            <div class="col-md-4">
                <textarea class="form-control" name="details[0][keterangan]" placeholder="Keterangan (opsional)"></textarea>
            </div>
            <div class="col-md-1">
                <button type="button" class="btn btn-danger remove-row" style="display:none;"><i class="bi bi-trash"></i></button>
            </div>
        </div>
    </div>
    <button type="button" class="btn btn-primary mb-3 mt-3" id="add-detail">Tambah Paket Lain</button>

    <button type="submit" class="btn btn-warning">Update Transaksi</button>
    <a href="{{ route('transaksis.index') }}" class="btn btn-secondary">Batal</a>
</form>

<script>
    let detailCount = 1;
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

        // Tambah event remove untuk row baru
        newRow.querySelector('.remove-row').addEventListener('click', function() {
            newRow.remove();
        });
    });

    // Remove untuk row pertama kalau ada lebih dari satu (opsional)
    document.addEventListener('click', function(e) {
        if (e.target.classList.contains('remove-row')) {
            e.target.closest('.detail-row').remove();
        }
    });
</script>
@endsection