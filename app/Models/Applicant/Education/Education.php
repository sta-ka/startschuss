<?php namespace App\Models\Applicant\Education;

use Illuminate\Database\Eloquent\Model;

use Date;

class Education extends Model {

    /**
     * The table associated with the model.
     *
     * @var string
     */
	public $table = 'education';

    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
	protected $guarded = [];

/*
|--------------------------------------------------------------------------
|       Accessors and Mutators
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