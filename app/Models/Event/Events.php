<?php namespace App\Models\Event;

use App\Models;
use App\Models\NotifierTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Venturecraft\Revisionable\RevisionableTrait;

use Date;

class Events extends Model {

	use SoftDeletes, RevisionableTrait, NotifierTrait;

    public static $notfierMsgKey = 'profile_update';

    /**
     * The table associated with the model.
     *
     * @var string
     */
	public $table = 'events';

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

	public function user()
	{
		return $this->belongsTo(Models\User\User::class);
	}

	public function applications()
	{
		return $this->hasMany(Models\Applicant\Application\Application::class, 'event_id');
	}

	public function requestedBy()
	{
		return $this->belongsTo(Models\User\User::class, 'requested_by', 'id');
	}

	public function organizer()
	{
		return $this->belongsTo(Models\Organizer\Organizer::class);
	}

	public function region()
	{
		return $this->belongsTo(Models\Misc\Region\Region::class);
	}

	public function participants()
	{
		return $this->belongsToMany(Models\Company\Company::class, 'participants', 'event_id', 'company_id')
					->withPivot('interview')
					->withPivot('comment')
					->withTimestamps();
	}

/*
|--------------------------------------------------------------------------
|       Scopes
|--------------------------------------------------------------------------
*/

	public function scopeUpcoming($query, $upcoming = true)
	{
		if ($upcoming == false) {
            return $query->where('end_date', '<=', new \DateTime('yesterday'));
        }

		return $query->where('end_date', '>', new \DateTime('yesterday'));
	}

	public function scopeVisible($query)
	{
		return $query->where('visible', 1);
	}

/*
|--------------------------------------------------------------------------
|       Accessors and Mutators
|--------------------------------------------------------------------------
*/

    /**
     * Get 'start_date' attribute in german format
     *
     * @param $date
     *
     * @return string
     */
    public function getStartDateAttribute($date)
	{
		return Date::sqlToGerman($date);
	}

    /**
     * Set 'start_date' attribute in SQL format
     *
     * @param $date
     *
     * @return string
     */
    public function setStartDateAttribute($date)
	{
		$this->attributes['start_date'] = Date::germanToSql($date);
	}

    /**
     * Get 'end_date' attribute in german format
     *
     * @param $date
     *
     * @return string
     */
    public function getEndDateAttribute($date)
	{
		return Date::sqlToGerman($date);
	}
	
    /**
     * Set 'end_date' attribute in SQL format
     *
     * @param $date
     *
     * @return string
     */
    public function setEndDateAttribute($date)
	{
		$this->attributes['end_date'] = Date::germanToSql($date);
	}

}