@extends('layouts.app')

@section('title', 'Daftar Paket Cucian')

@section('content')
<h1>Daftar Paket Cucian</h1>
<a href="{{ route('pakets.create') }}" class="btn btn-primary mb-3"><i class="bi bi-plus"></i> Tambah Paket</a>
<table class="table table-striped">
    <thead>
        <tr>
            <th>ID</th>
            <th>Outlet</th>
            <th>Jenis</th>
            <th>Nama Paket</th>
            <th>Harga</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        @foreach($pakets as $paket)
            <tr>
                <td>{{ $paket->id }}</td>
                <td>{{ $paket->outlet->nama }}</td>
                <td>{{ ucfirst($paket->jenis) }}</td>
                <td>{{ $paket->nama_paket }}</td>
                <td>Rp {{ number_format($paket->harga, 0, ',', '.') }}</td>
                <td>
                    <a href="{{ route('pakets.edit', $paket) }}" class="btn btn-warning btn-sm"><i class="bi bi-pencil"></i> Edit</a>
                    <form action="{{ route('pakets.destroy', $paket) }}" method="POST" style="display:inline;">
                        @csrf @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Yakin hapus paket ini?')"><i class="bi bi-trash"></i> Hapus</button>
                    </form>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
@endsection