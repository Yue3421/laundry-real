<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('tb_outlet', function (Blueprint $table) {
            $table->id(); // id: int(11), primary key, auto-increment
            $table->string('nama', 100); // nama: varchar(100)
            $table->text('alamat'); // alamat: text
            $table->string('tlp', 15); // tlp: varchar(15)
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('tb_outlet');
    }
};
