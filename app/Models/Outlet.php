<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Outlet extends Model
{
    use HasFactory;

    protected $table = 'tb_outlet';
    public $timestamps = false; // Sesuai PDM, no timestamps

    protected $fillable = [
        'nama',
        'alamat',
        'tlp',
    ];

    // Relationships
    public function users()
    {
        return $this->hasMany(User::class, 'id_outlet');
    }

    public function pakets()
    {
        return $this->hasMany(Paket::class, 'id_outlet');
    }

    public function transaksis()
    {
        return $this->hasMany(Transaksi::class, 'id_outlet');
    }
}