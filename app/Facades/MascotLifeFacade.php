<?php

namespace App\Facades;

use App\Helpers\MascotLife;
use Illuminate\Support\Facades\Facade;

class MascotLifeFacade extends Facade
{
    protected static function getFacadeAccessor()
    { 
        return MascotLife::class;
    }
}