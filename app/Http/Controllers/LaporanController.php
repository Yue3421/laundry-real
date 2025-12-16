<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transaksi;
use Carbon\Carbon;

class LaporanController extends Controller
{
    public function index(Request $request)
    {
        $transaksis = Transaksi::with(['detailTransaksis.paket', 'member'])
            ->when($request->start_date, function ($query, $start_date) {
                $query->where('tgl', '>=', Carbon::parse($start_date)->startOfDay());
            })
            ->when($request->end_date, function ($query, $end_date) {
                $query->where('tgl', '<=', Carbon::parse($end_date)->endOfDay());
            })
            ->get();

        return view('laporans.index', compact('transaksis'));
    }
}