<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('tb_detail_transaksi', function (Blueprint $table) {
            $table->id(); // id: int(11), primary key, auto-increment
            $table->foreignId('id_transaksi')->constrained('tb_transaksi'); // id_transaksi: int(11), foreign key ke tb_transaksi
            $table->foreignId('id_paket')->constrained('tb_paket'); // id_paket: int(11), foreign key ke tb_paket
            $table->double('qty'); // qty: double
            $table->text('keterangan'); // keterangan: text
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('tb_detail_transaksi');
    }
};