<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('tb_user', function (Blueprint $table) {
            $table->id(); // id: int(11), primary key, auto-increment
            $table->string('nama', 100); // nama: varchar(100)
            $table->string('username', 30); // username: varchar(30)
            $table->text('password'); // password: text (untuk hashed password)
            $table->foreignId('id_outlet')->constrained('tb_outlet'); // id_outlet: int(11), foreign key ke tb_outlet
            $table->enum('role', ['admin', 'kasir', 'owner']); // role: enum(admin,kasir,owner)
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('tb_user');
    }
};
