<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable; // Untuk auth
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $table = 'tb_user';
    public $timestamps = false;

    protected $fillable = [
        'nama',
        'username',
        'password',
        'id_outlet',
        'role',
    ];

    protected $hidden = [
        'password',
    ];

    // Relationships
    public function outlet()
    {
        return $this->belongsTo(Outlet::class, 'id_outlet');
    }

    public function transaksis()
    {
        return $this->hasMany(Transaksi::class, 'id_user');
    }
}