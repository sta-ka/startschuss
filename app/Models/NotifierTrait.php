<?php namespace App\Models;

trait NotifierTrait {

    public static function bootNotifierTrait()
    {
        parent::updating(function(){
            notify('error', static::$notfierMsgKey);
        });

        parent::updated(function(){
            notify('success', static::$notfierMsgKey);
        });
    }

}