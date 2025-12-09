<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaksi extends Model
{
    use HasFactory;

    protected $table = 'tb_transaksi';
    public $timestamps = false;

    protected $fillable = [
        'id_outlet',
        'kode_invoice',
        'id_member',
        'tgl',
        'batas_waktu',
        'tgl_bayar',
        'biaya_tambahan',
        'diskon',
        'pajak',
        'status',
        'dibayar',
        'id_user',
    ];
protected $casts = [
    'tgl' => 'datetime',
    'batas_waktu' => 'datetime',
    'tgl_bayar' => 'datetime', // Nullable, jadi aman
];
    // Relationships
    public function outlet()
    {
        return $this->belongsTo(Outlet::class, 'id_outlet');
    }
    public function member()
    {
        return $this->belongsTo(Member::class, 'id_member');
    }
    public function user()
    {
        return $this->belongsTo(User::class, 'id_user');
    }
    public function detailTransaksis()
    {
    return $this->hasMany(DetailTransaksi::class, 'id_transaksi');
    }
}