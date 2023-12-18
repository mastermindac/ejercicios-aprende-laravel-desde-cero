<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'price',
        'user:id',
    ];

    public function user() { 
        //representa la relacion de 1 usuario tiene muchos productos
        return $this->belongsTo(User::class);
    }
}

