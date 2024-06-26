<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BarangVarian extends Model
{
    use HasFactory;

    protected $table = 'barang_varian';

    public function barang()
    {
        return $this->belongsTo(Barang::class, 'kode_barang');
    }
}
