<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('tb_transaksi', function (Blueprint $table) {
            $table->id(); // id: int(11), primary key, auto-increment
            $table->foreignId('id_outlet')->constrained('tb_outlet'); // id_outlet: int(11), foreign key ke tb_outlet
            $table->string('kode_invoice', 100); // kode_invoice: varchar(100)
            $table->foreignId('id_member')->constrained('tb_member'); // id_member: int(11), foreign key ke tb_member
            $table->dateTime('tgl'); // tgl: datetime
            $table->dateTime('batas_waktu'); // batas_waktu: datetime
            $table->dateTime('tgl_bayar')->nullable(); // tgl_bayar: datetime (nullable jika belum bayar)
            $table->integer('biaya_tambahan'); // biaya_tambahan: int(11)
            $table->double('diskon'); // diskon: double
            $table->integer('pajak'); // pajak: int(11)
            $table->enum('status', ['baru', 'proses', 'selesai', 'diambil']); // status: enum(baru,proses,selesai,diambil)
            $table->enum('dibayar', ['dibayar', 'belum_dibayar']); // dibayar: enum(dibayar,belum_dibayar)
            $table->foreignId('id_user')->constrained('tb_user'); // id_user: int(11), foreign key ke tb_user
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('tb_transaksi');
    }
};