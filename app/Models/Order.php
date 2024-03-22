<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    public function konsumen()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function items()
    {
        return $this->hasMany(OrderItem::class, 'order_id');
    }

    public function payments()
    {
        return $this->hasMany(OrderPayment::class, 'order_id');
    }

    public function subtotalHarga(): Attribute
    {
        return Attribute::make(
            get: fn () => $this->items->sum('total')
        );
    }

    public function totalHarga(): Attribute
    {
        return Attribute::make(
            get: fn () => $this->items->sum('total') * $this->hari
        );
    }

    public function dibayar(): Attribute
    {
        return Attribute::make(
            get: fn () => $this->payments->sum('nominal')
        );
    }

    public function sisa(): Attribute
    {
        return Attribute::make(
            get: fn () => $this->total_harga - $this->dibayar
        );
    }
}
