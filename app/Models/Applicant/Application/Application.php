<?php namespace App\Models\Applicant\Application;

use App\Models;
use App\Presenters\DatePresenter;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Application extends Model {

	use DatePresenter, SoftDeletes;

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
		return $this->belongsTo(Models\User\User::class, 'applicant_id');
	}

	public function applicant()
	{
		return $this->belongsTo(Models\Applicant\Applicant::class, 'applicant_id', 'user_id');
	}

	public function company()
	{
		return $this->belongsTo(Models\Company\Company::class);
	}

	public function event()
	{
		return $this->belongsTo(Models\Event\Events::class);
	}


}