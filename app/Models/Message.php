<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    // Câmpurile pe care avem voie să le salvăm direct din request
    protected $fillable = [
        'nume',
        'email',
        'subiect',
        'continut',
        'citit'
    ];
}