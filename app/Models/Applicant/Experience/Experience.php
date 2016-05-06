<?php namespace App\Models\Applicant\Experience;

use Illuminate\Database\Eloquent\Model;

use Date;

class Experience extends Model {

    /**
     * The table associated with the model.
     *
     * @var string
     */
	public $table = 'experience';

    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
	protected $guarded = [];

/*
|--------------------------------------------------------------------------
|  		Accessors and Mutators
|--------------------------------------------------------------------------
*/

    /**
     * Get 'start_date' attribute in german format.
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
     * Get 'end_date' attribute in german format.
     *
     * @param $date
     *
     * @return string
     */
	public function getEndDateAttribute($date)
	{
		return Date::sqlToGerman($date);
	}

}