<?php

namespace App\Facades;

use Illuminate\Support\Facades\Facade;

class TwitterAuth extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'twitterAuth';
    }
}
