<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePesananTable extends Migration
{
    public function up()
    {
        Schema::create('pesanan', function (Blueprint $table) {
            $table->id();
            $table->foreignId('barang_id')->constrained('barang')->onDelete('cascade');  // Relasi ke Barang
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');   // Relasi ke User
            $table->integer('jumlah');
            $table->integer('status')->default(0); // Default status misalnya 0: pending, 1: selesai
            $table->integer('total');  // Total harga
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('pesanan');
    }
}