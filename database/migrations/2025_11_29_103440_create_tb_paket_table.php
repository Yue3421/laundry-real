<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('tb_paket', function (Blueprint $table) {
            $table->id(); // id: int(11), primary key, auto-increment
            $table->foreignId('id_outlet')->constrained('tb_outlet'); // id_outlet: int(11), foreign key ke tb_outlet
            $table->enum('jenis', ['kiloan', 'selimut', 'bed_cover', 'kaos', 'lain']); // jenis: enum(kiloan,selimut,bed_cover,kaos,lain)
            $table->string('nama_paket', 100); // nama_paket: varchar(100)
            $table->integer('harga'); // harga: int(11)
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('tb_paket');
    }
};