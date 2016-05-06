<?php namespace App\Models\Company;

use App\Models;
use App\Models\NotifierTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Venturecraft\Revisionable\RevisionableTrait;

class Company extends Model {

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

	public function users()
	{
		return $this->belongsToMany(Models\User\User::class, 'company_users', 'company_id', 'user_id');
	}

	public function applications()
	{
		return $this->hasMany(Models\Applicant\Application\Application::class, 'company_id');
	}

	public function events()
	{
		return $this->belongsToMany(Models\Event\Events::class, 'participants', 'company_id', 'event_id');
	}

	public function jobs()
	{
		return $this->hasMany(Models\Company\Job\Job::class, 'company_id');
	}

	public function participants()
	{
		return $this->belongsToMany(Models\Event\Events::class, 'participants', 'company_id', 'event_id')
					->withPivot('interview')
					->withPivot('comment')
					->withTimestamps();
	}

}