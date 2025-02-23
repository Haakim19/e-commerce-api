<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Procucts extends Model
{
    use HasFactory, HasApiTokens, Notifiable;

    public function categories()
    {
        return $this->belongsTo(Categories::class);
    }

    public function shoppingCart()
    {
        return $this->hasMany(ShoppingCart::class);
    }

    public function orderItem()
    {
        return $this->hasMany(OrderItem::class);
    }

    public function reviews()
    {
        return $this->hasMany(Reviews::class);
    }
}
