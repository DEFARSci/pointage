<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserPointer extends Model
{
    use HasFactory;
    protected $fillable=[
        'carte_id',
        'prenom',
        'nom',
        'email',
        'phone'
    ];

   
}
