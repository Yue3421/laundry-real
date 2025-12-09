<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Paket extends Model
{
    use HasFactory;

    protected $table = 'tb_paket';
    public $timestamps = false;

    protected $fillable = [
        'id_outlet',
        'jenis',
        'nama_paket',
        'harga',
    ];

    // Relationships
    public function outlet()
    {
        return $this->belongsTo(Outlet::class, 'id_outlet');
    }

    public function detailTransaksis()
    {
        return $this->hasMany(DetailTransaksi::class, 'id_paket');
    }
}