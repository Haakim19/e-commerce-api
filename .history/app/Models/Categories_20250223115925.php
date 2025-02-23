<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Categories extends Model
{

    use HasFactory, HasApiTokens, Notifiable;

    public function products()
    {
        return $this->hasMany(Categories::class);
    }
}
