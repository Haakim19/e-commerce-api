<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Categories extends Model
{

    use HasFactory, HasApiTokens, Notifiable;

    public function products()
    {
        return $this->hasMany(Products::class);
    }
}
