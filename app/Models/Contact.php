<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Contact model.
 * 
 * @property string $name
 * @property string $phone_number
 * @property string $age
 * @property string $email
 * 
 */
class Contact extends Model
{
    use HasFactory;

    protected $fillable = ["name", "phone_number","age", "email", "user_id"];
}
