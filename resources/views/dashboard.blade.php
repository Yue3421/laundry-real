@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
<h1>Selamat Datang, {{ auth()->user()->nama }} ({{ auth()->user()->role }})</h1>
<p>Outlet: {{ auth()->user()->outlet->nama }}</p>
<div class="row">
    <div class="col-md-4">
        <div class="card text-center">
            <div class="card-body">
                <i class="bi bi-cart fs-1 text-primary"></i>
                <h5>Jumlah Transaksi Hari Ini</h5>
                <p>{{ App\Models\Transaksi::whereDate('tgl', now())->count() }}</p>
            </div>
        </div>
    </div>
    <!-- Tambah card lain misal jumlah pelanggan, dll. -->
    <div class="col-md-4">
        <div class="card text-center">
            <div class="card-body">
                <i class="bi bi-people fs-1 text-primary"></i>
                <h5>Jumlah Pelanggan</h5>
                <p>{{ App\Models\Member::count() }}</p>
            </div>
        </div>
    </div>
</div>
@endsection