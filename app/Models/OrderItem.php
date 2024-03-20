<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{
    use HasFactory;

    public function order()
    {
        return $this->belongsTo(Order::class, 'order_id');
    }

    public function varian()
    {
        return $this->belongsTo(BarangVarian::class, 'varian_id');
    }

    public function total(): Attribute
    {
        return Attribute::make(
            get: fn () => $this->varian->barang->harga * $this->qty
        );
    }
}
