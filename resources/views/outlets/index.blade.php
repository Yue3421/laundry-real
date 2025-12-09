@extends('layouts.app')

@section('title', 'Daftar Outlet')

@section('content')
<h1>Daftar Outlet</h1>
<a href="{{ route('outlets.create') }}" class="btn btn-primary mb-3"><i class="bi bi-plus"></i> Tambah Outlet</a>
<table class="table table-striped">
    <thead>
        <tr>
            <th>ID</th>
            <th>Nama</th>
            <th>Alamat</th>
            <th>Telepon</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        @foreach($outlets as $outlet)
            <tr>
                <td>{{ $outlet->id }}</td>
                <td>{{ $outlet->nama }}</td>
                <td>{{ $outlet->alamat }}</td>
                <td>{{ $outlet->tlp }}</td>
                <td>
                    <a href="{{ route('outlets.edit', $outlet) }}" class="btn btn-warning btn-sm"><i class="bi bi-pencil"></i> Edit</a>
                    <form action="{{ route('outlets.destroy', $outlet) }}" method="POST" style="display:inline;">
                        @csrf @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Yakin hapus outlet ini?')"><i class="bi bi-trash"></i> Hapus</button>
                    </form>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
@endsection