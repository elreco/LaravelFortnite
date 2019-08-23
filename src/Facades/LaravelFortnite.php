<?php

namespace elreco\LaravelFortnite\Facades;

use Illuminate\Support\Facades\Facade;

class LaravelFortnite extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'laravelfortnite';
    }
}
