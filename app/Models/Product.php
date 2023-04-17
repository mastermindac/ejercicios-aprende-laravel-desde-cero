<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\Pivot;

class Product extends Pivot
{
    use HasFactory;

    public $fillable = [
        'name',
        'description',
        'price'
    ];

    public function user() {

        $this->belongsTo(User::class);
    }
    
}
