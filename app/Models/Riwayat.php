<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Riwayat extends Model
{
    // Relasi kebalikannya, yaitu milik Pesanan
    public function pesanan()
    {
        return $this->belongsTo(Pesanan::class);
    }
}