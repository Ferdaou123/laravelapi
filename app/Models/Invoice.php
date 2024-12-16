<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    protected $fillable = [
        'client_name',
        'amount',
        'status',
        'file_path', // Ajoutez cette ligne si elle n'existe pas
    ];
    
}
