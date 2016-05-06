<?php namespace App\Models\Organizer;

use App\Models;
use App\Models\NotifierTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Venturecraft\Revisionable\RevisionableTrait;

class Organizer extends Model {
	
	use SoftDeletes, RevisionableTrait, NotifierTrait;

    public static $notfierMsgKey = 'profile_update';

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
		return $this->hasMany(Models\Event\Events::class);
	}

}