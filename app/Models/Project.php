<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    // Îi spunem lui Laravel că această coloană este un array/json
    protected $casts = [
        'tehnologii' => 'array',
    ];
}