<?php namespace App\Models\Misc\City;

use App\Models\NotifierTrait;
use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    use NotifierTrait;

    public static $notfierMsgKey = 'profile_update';

    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = false;

    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $guarded = [];

}