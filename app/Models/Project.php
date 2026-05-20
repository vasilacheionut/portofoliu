<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    protected $fillable = ['titlu', 'descriere', 'tehnologii', 'imagine', 'link_github'];

    protected $casts = [
        'tehnologii' => 'array',
    ];
}