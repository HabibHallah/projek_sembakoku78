<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Barang extends Model
{
    use HasFactory;

    protected $table = 'barang'; // Nama tabel

    protected $fillable = [
        'nama_barang', 
        'stok',
        'harga', 
        'status', 
        'foto', 
    ];

    // Format harga menjadi 'Rp'
    public function getFormattedHargaAttribute()
    {
        return 'Rp' . number_format($this->harga, 2, ',', '.');
    }

    // Relasi ke model Pesanan
    public function pesanan()
    {
        return $this->hasMany(Pesanan::class);
    }
}
