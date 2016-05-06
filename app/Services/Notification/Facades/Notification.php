<?php namespace App\Services\Notification\Facades;

use Illuminate\Support\Facades\Facade;

class Notification extends Facade {

    /**
     * Get name of binding in IoC container
     *
     * @return string
     */
    public static function getFacadeAccessor()
    {
        return 'notification';
    }

}