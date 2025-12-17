@extends('layouts.app')

@section('title', 'Edit Paket Cucian')

@section('content')
<h1>Edit Paket: {{ $paket->nama_paket }}</h1>
<form action="{{ route('pakets.update', $paket) }}" method="POST">
    @csrf @method('PUT')
    <div class="mb-3">
        <label for="id_outlet" class="form-label">Outlet</label>
        <select class="form-select" id="id_outlet" name="id_outlet" required>
            @foreach($outlets as $outlet)
                <option value="{{ $outlet->id }}" {{ $paket->id_outlet == $outlet->id ? 'selected' : '' }}>{{ $outlet->nama }}</option>
            @endforeach
        </select>
    </div>
    <div class="mb-3">
        <label for="jenis" class="form-label">Jenis</label>
        <select class="form-select" id="jenis" name="jenis" required>
            <option value="kiloan" {{ $paket->jenis == 'kiloan' ? 'selected' : '' }}>Kiloan</option>
            <option value="selimut" {{ $paket->jenis == 'selimut' ? 'selected' : '' }}>Selimut</option>
            <option value="bed_cover" {{ $paket->jenis == 'bed_cover' ? 'selected' : '' }}>Bed Cover</option>
            <option value="kaos" {{ $paket->jenis == 'kaos' ? 'selected' : '' }}>Kaos</option>
            <option value="lain" {{ $paket->jenis == 'lain' ? 'selected' : '' }}>Lain</option>
        </select>
    </div>
    <div class="mb-3">
        <label for="nama_paket" class="form-label">Nama Paket</label>
        <input type="text" class="form-control" id="nama_paket" name="nama_paket" value="{{ $paket->nama_paket }}" required>
    </div>
    <div class="mb-3">
        <label for="harga" class="form-label">Harga</label>
        <input type="number" class="form-control" id="harga" name="harga" value="{{ $paket->harga }}" required min="0">
    </div>
    <button type="submit" class="btn btn-warning">Update</button>
    <a href="{{ route('pakets.index') }}" class="btn btn-secondary">Batal</a>
</form>
@endsection