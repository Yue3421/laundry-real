<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transaksi;

class LaporanController extends Controller
{
    public function index(Request $request)
{
    // Check role: all boleh, tapi mungkin filter by outlet
    $transaksis = Transaksi::with(['detailTransaksis.paket', 'member'])
        ->whereBetween('tgl', [$request->start_date ?? now()->subMonth(), $request->end_date ?? now()])
        ->get();
    // Bisa generate PDF pakai Dompdf atau similar, tapi contoh return view
    return view('laporans.index', compact('transaksis'));
}
}