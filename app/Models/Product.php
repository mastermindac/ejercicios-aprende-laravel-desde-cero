<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $filleable = [
        'name',
        'description',
        'price'
    ];

    public function user() {
        return $this->belongsTo(User::class);
    }
}
