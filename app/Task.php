<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    protected $fillable = [
        'name',
        'due_date',
        'point',
        'status',
        'type_id',
        'user_id',
    ];
}
