<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pesanan extends Model
{
    use HasFactory;

    protected $table = 'pesanan';

    protected $fillable = [
        'barang_id',   // Foreign Key ke Barang
        'user_id',     // Foreign Key ke User
        'jumlah',      // Jumlah barang yang dipesan
        'status',      // Status pesanan (misalnya 0=Pending, 1=Selesai)
        'total',       // Total harga pesanan
    ];

    // Relasi ke model Barang
    public function barang()
    {
        return $this->belongsTo(Barang::class, 'barang_id');  // foreign key 'barang_id'
    }

    // Relasi ke model User
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id'); // foreign key 'user_id'
    }

    public function riwayats()
    {
        return $this->hasMany(Riwayat::class);
    }
}
