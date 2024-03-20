<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Barang extends Model
{
    use HasFactory;
    protected $table = 'barang';

    public $primaryKey = 'kode';
    public $incrementing = false;

    public function varian(): HasMany
    {
        return $this->hasMany(BarangVarian::class, 'kode_barang', 'kode');
    }
}
