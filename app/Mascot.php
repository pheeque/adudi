<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Mascot extends Model
{
    protected $fillable = [
        'id',
        'exp',
        'level',
    ];
}
