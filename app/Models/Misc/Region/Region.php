<?php namespace App\Models\Misc\Region;

use App\Models\NotifierTrait;
use Illuminate\Database\Eloquent\Model;

class Region extends Model {

    use NotifierTrait;

    public static $notfierMsgKey = 'region_update';

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

/*
|--------------------------------------------------------------------------
|       Relationships
|--------------------------------------------------------------------------
*/

	public function events()
	{
		return $this->hasMany('App\Models\Event\Events');
	}
}