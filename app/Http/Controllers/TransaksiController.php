<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transaksi;
use App\Models\DetailTransaksi;
use App\Models\Member;
use App\Models\Paket;
use App\Models\Outlet;
use Illuminate\Support\Str;
use Carbon\Carbon;

class TransaksiController extends Controller
{
    public function index()
    {
        $transaksis = Transaksi::with(['member', 'user', 'detailTransaksis.paket'])->get(); // Filter per outlet kalau multi
        return view('transaksis.index', compact('transaksis'));
    }

    public function create()
    {
        if (!in_array(auth()->user()->role, ['admin', 'kasir'])) {
            abort(403, 'Akses ditolak!');
        }
        $members = Member::all();
        $pakets = Paket::all(); // Filter per outlet kalau perlu
        return view('transaksis.create', compact('members', 'pakets'));
    }

    public function store(Request $request)
    {
        if (!in_array(auth()->user()->role, ['admin', 'kasir'])) {
            abort(403);
        }
        $request->validate([
            'id_member' => 'required|exists:tb_member,id',
            'tgl' => 'required|date',
            'batas_waktu' => 'required|date|after_or_equal:tgl',
            'biaya_tambahan' => 'nullable|integer|min:0',
            'diskon' => 'nullable|numeric|min:0|max:100',
            'pajak' => 'nullable|integer|min:0',
            'status' => 'required|in:baru,proses,selesai,diambil',
            'dibayar' => 'required|in:belum_dibayar,dibayar',
            'details' => 'required|array|min:1',
            'details.*.id_paket' => 'required|exists:tb_paket,id',
            'details.*.qty' => 'required|numeric|min:0.1',
            'details.*.keterangan' => 'nullable|string',
        ]);

        $transaksi = Transaksi::create([
            'id_outlet' => auth()->user()->id_outlet, // Ambil dari user login
            'kode_invoice' => 'INV-' . strtoupper(Str::random(8)),
            'id_member' => $request->id_member,
            'tgl' => $request->tgl,
            'batas_waktu' => $request->batas_waktu,
            'tgl_bayar' => $request->dibayar == 'dibayar' ? Carbon::now() : null,
            'biaya_tambahan' => $request->biaya_tambahan ?? 0,
            'diskon' => $request->diskon ?? 0,
            'pajak' => $request->pajak ?? 0,
            'status' => $request->status,
            'dibayar' => $request->dibayar,
            'id_user' => auth()->id(),
        ]);

        foreach ($request->details as $detail) {
            DetailTransaksi::create([
                'id_transaksi' => $transaksi->id,
                'id_paket' => $detail['id_paket'],
                'qty' => $detail['qty'],
                'keterangan' => $detail['keterangan'] ?? '',
            ]);
        }

        return redirect()->route('transaksis.index')->with('success', 'Transaksi berhasil dibuat!');
    }

    public function show(Transaksi $transaksi)
    {
        $transaksi->load(['detailTransaksis.paket', 'member', 'user']);
        return view('transaksis.show', compact('transaksi'));
    }

    public function edit(Transaksi $transaksi)
    {
        if (!in_array(auth()->user()->role, ['admin', 'kasir'])) {
            abort(403);
        }
        $members = Member::all();
        $pakets = Paket::all();
        $transaksi->load('detailTransaksis');
        return view('transaksis.edit', compact('transaksi', 'members', 'pakets'));
    }

    public function update(Request $request, Transaksi $transaksi)
    {
        if (!in_array(auth()->user()->role, ['admin', 'kasir'])) {
            abort(403);
        }
        $request->validate([
            'id_member' => 'required|exists:tb_member,id',
            'tgl' => 'required|date',
            'batas_waktu' => 'required|date|after_or_equal:tgl',
            'biaya_tambahan' => 'nullable|integer|min:0',
            'diskon' => 'nullable|numeric|min:0|max:100',
            'pajak' => 'nullable|integer|min:0',
            'status' => 'required|in:baru,proses,selesai,diambil',
            'dibayar' => 'required|in:belum_dibayar,dibayar',
            'details' => 'required|array|min:1',
            'details.*.id_paket' => 'required|exists:tb_paket,id',
            'details.*.qty' => 'required|numeric|min:0.1',
            'details.*.keterangan' => 'nullable|string',
        ]);

        $transaksi->update([
            'id_member' => $request->id_member,
            'tgl' => $request->tgl,
            'batas_waktu' => $request->batas_waktu,
            'tgl_bayar' => $request->dibayar == 'dibayar' ? ($transaksi->tgl_bayar ?? Carbon::now()) : null,
            'biaya_tambahan' => $request->biaya_tambahan ?? 0,
            'diskon' => $request->diskon ?? 0,
            'pajak' => $request->pajak ?? 0,
            'status' => $request->status,
            'dibayar' => $request->dibayar,
        ]);

        // Hapus detail lama, tambah baru
        $transaksi->detailTransaksis()->delete();
        foreach ($request->details as $detail) {
            DetailTransaksi::create([
                'id_transaksi' => $transaksi->id,
                'id_paket' => $detail['id_paket'],
                'qty' => $detail['qty'],
                'keterangan' => $detail['keterangan'] ?? '',
            ]);
        }

        return redirect()->route('transaksis.index')->with('success', 'Transaksi berhasil diupdate!');
    }

    public function destroy(Transaksi $transaksi)
    {
        if (!in_array(auth()->user()->role, ['admin', 'kasir'])) {
            abort(403);
        }
        $transaksi->detailTransaksis()->delete();
        $transaksi->delete();
        return redirect()->route('transaksis.index')->with('success', 'Transaksi berhasil dihapus!');
    }
}