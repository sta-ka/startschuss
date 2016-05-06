<?php namespace App\Models\Applicant;

use App\Models;
use App\Models\NotifierTrait;
use App\Presenters\DatePresenter;
use Illuminate\Database\Eloquent\Model;

class Applicant extends Model {

    use DatePresenter, NotifierTrait;

    /**
     * Message key for notifications
     *
     * @var string
     */
    public static $notfierMsgKey = 'profile_update';

    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
	protected $guarded = [];

/*
|--------------------------------------------------------------------------
| 		Relationships
|--------------------------------------------------------------------------
*/

	public function user()
	{
		return $this->belongsTo(Models\User\User::class, 'user_id');
	}

	public function educations()
	{
		return $this->hasMany(Education\Education::class, 'applicant_id')->orderBy('end_date', 'desc');
	}

	public function experiences()
	{
		return $this->hasMany(Experience\Experience::class, 'applicant_id')->orderBy('end_date', 'desc');
	}

/*
|--------------------------------------------------------------------------
|       Accessors and Mutators
|--------------------------------------------------------------------------
*/

    /**
     * Get 'birthday' attribute
     *
     * @param $value
     *
     * @return string
     */
    public function getBirthdayAttribute($value)
    {
        if (! $value) {
            return false;
        }

        return \Date::sqlToGerman($value);
    }

    /**
     * Set 'birthday' attribute
     *
     * @param $date
     *
     * @return string
     */
    public function setBirthdayAttribute($date)
    {
        if (! $date) {
            return false;
        }

        $this->attributes['birthday'] = \Date::germanToSql($date);
    }

}