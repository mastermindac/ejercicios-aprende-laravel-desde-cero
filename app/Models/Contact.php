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

//esta es la relacion inverda de la uqe hay en User.php

//Este contacto pertenece a un usuario

    public function user() {
        return $this->belongsTo(User::class);
    }
}
