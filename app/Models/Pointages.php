<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;


class Pointages extends Model
{
    use HasFactory;

    protected $fillable = [
        'pointers_carte_id',
        'date',
        'heurDarriver',
       ' heurDepart',
        'paiement_retard',
    ];

   
    }

