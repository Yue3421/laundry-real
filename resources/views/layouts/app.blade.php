<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title') - Aplikasi Laundry</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css"> <!-- Untuk icon -->
    <style>
        body { background-color: #f8f9fa; }
        .sidebar { height: 100vh; position: fixed; top: 0; left: 0; width: 250px; background: #343a40; color: white; padding: 20px; }
        .sidebar a { color: white; text-decoration: none; display: block; padding: 10px; }
        .sidebar a:hover { background: #495057; }
        .content { margin-left: 250px; padding: 20px; }
    </style>
</head>
<body>
    <div class="sidebar">
        <h4 class="text-center">Laundry App</h4>
        <hr>
        @if(auth()->check())
            <a href="/dashboard"><i class="bi bi-house"></i> Dashboard</a>
            @if(in_array(auth()->user()->role, ['admin', 'kasir']))
                <a href="/members"><i class="bi bi-people"></i> Pelanggan</a>
                <a href="/transaksis"><i class="bi bi-cart"></i> Transaksi</a>
            @endif
            @if(auth()->user()->role == 'admin')
                <a href="/outlets"><i class="bi bi-shop"></i> Outlet</a>
                <a href="/pakets"><i class="bi bi-box"></i> Paket Cucian</a>
                <a href="/users"><i class="bi bi-person"></i> Pengguna</a>
            @endif
            <a href="/laporans"><i class="bi bi-file-earmark-bar-graph"></i> Laporan</a>
            <form action="/logout" method="POST" class="mt-5">
                @csrf
                <button type="submit" class="btn btn-danger w-100"><i class="bi bi-box-arrow-right"></i> Logout</button>
            </form>
        @endif
    </div>
    <div class="content">
        @yield('content')
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>