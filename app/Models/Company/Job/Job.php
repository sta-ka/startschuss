<?php namespace App\Models\Company\Job;

use App\Models;
use App\Models\NotifierTrait;
use App\Presenters\DatePresenter;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Job extends Model {

    use DatePresenter, SoftDeletes, NotifierTrait;

    public static $notfierMsgKey = 'job_update';

    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $guarded = [];

/*
|--------------------------------------------------------------------------
| Relationships
|--------------------------------------------------------------------------
*/

	public function company()
	{
		return $this->belongsTo(Models\Company\Company::class);
	}

/*
|--------------------------------------------------------------------------
| Scopes
|--------------------------------------------------------------------------
*/

	public function scopeActive($query)
	{
		return $query->where('active', 1);
	}

	public function scopeApproved($query, $approved = true)
	{
		return $query->where('approved', $approved);
	}

}