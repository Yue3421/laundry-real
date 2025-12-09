@extends('layouts.app')

@section('title', 'Tambah Paket Cucian')

@section('content')
<h1>Tambah Paket Baru</h1>
<form action="{{ route('pakets.store') }}" method="POST">
    @csrf
    <div class="mb-3">
        <label for="id_outlet" class="form-label">Outlet</label>
        <select class="form-select" id="id_outlet" name="id_outlet" required>
            @foreach($outlets as $outlet)
                <option value="{{ $outlet->id }}">{{ $outlet->nama }}</option>
            @endforeach
        </select>
    </div>
    <div class="mb-3">
        <label for="jenis" class="form-label">Jenis</label>
        <select class="form-select" id="jenis" name="jenis" required>
            <option value="kiloan">Kiloan</option>
            <option value="selimut">Selimut</option>
            <option value="bed_cover">Bed Cover</option>
            <option value="kaos">Kaos</option>
            <option value="lain">Lain</option>
        </select>
    </div>
    <div class="mb-3">
        <label for="nama_paket" class="form-label">Nama Paket</label>
        <input type="text" class="form-control" id="nama_paket" name="nama_paket" required>
    </div>
    <div class="mb-3">
        <label for="harga" class="form-label">Harga</label>
        <input type="number" class="form-control" id="harga" name="harga" required min="0">
    </div>
    <button type="submit" class="btn btn-primary">Simpan</button>
    <a href="{{ route('pakets.index') }}" class="btn btn-secondary">Batal</a>
</form>
@endsection