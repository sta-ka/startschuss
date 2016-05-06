<?php namespace App\Services\Date\Facades;

use Illuminate\Support\Facades\Facade;

class Date extends Facade {

    /**
     * Get name of binding in IoC container
     *
     * @return string
     */
    public static function getFacadeAccessor()
    {
        return 'date';
    }

}