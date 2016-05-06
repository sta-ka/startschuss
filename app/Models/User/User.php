<?php namespace App\Models\User;

use App\Models;
use App\Presenters\DatePresenter;
use Illuminate\Database\Eloquent\Model;

use Venturecraft\Revisionable\RevisionableTrait;
use Illuminate\Database\Eloquent\SoftDeletes;

class User extends Model {

	use SoftDeletes, RevisionableTrait, DatePresenter;

    /**
     * The table associated with the model.
     *
     * @var string
     */
	protected $table = 'users';

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
	protected $hidden = ['password'];

    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
	protected $guarded = ['password'];

	protected $dontKeepRevisionOf = [
	    'activated_at',
	    'activation_code',
	    'reset_password_code'
	];

    /**
     * The list of attributes to cast.
     *
     * @var array
     */
    protected $casts = [
        'settings' => 'array',
    ];
/*
|--------------------------------------------------------------------------
|       Model Events
|--------------------------------------------------------------------------
*/

    public static function boot()
    {
        parent::boot();

        static::creating(function(){
            notify('error', 'user_created');
        });

        static::created(function(){
            notify('success', 'user_created');
        });

    }
/*
|--------------------------------------------------------------------------
|       Relationships
|--------------------------------------------------------------------------
*/

	public function applications()
	{
		return $this->hasMany(Models\Applicant\Application\Application::class, 'applicant_id');
	}

	public function events()
	{
		return $this->hasMany(Models\Event\Events::class, 'user_id');
	}
	
	public function company()
	{
		return $this->belongsToMany(Models\Company\Company::class, 'company_users', 'user_id', 'company_id');
	}

	public function logins()
	{
		return $this->hasMany(Models\User\Login\Login::class, 'user_id');
	}	

	public function group()
	{
		return $this->belongsToMany(Models\User\Group\Group::class, 'users_groups', 'user_id', 'group_id');
	}

	public function throttle()
	{
		return $this->hasOne(Models\User\Throttle\Throttle::class, 'user_id');
	}

	public function applicant()
	{
		return $this->hasOne(Models\Applicant\Applicant::class, 'user_id');
	}

/*
|--------------------------------------------------------------------------
|       Methods
|--------------------------------------------------------------------------
*/

    /**
     * Get the user settings.
     *
     * @return Settings
     */
    public function settings()
    {
        return new Settings($this->settings, $this);
    }

/*
|--------------------------------------------------------------------------
|       Accessors and Mutators
|--------------------------------------------------------------------------
*/

    /**
     * Get 'last_login' attribute.
     *
     * @param $date
     *
     * @return string
     */
    public function getLastLoginAttribute($date)
    {
        if ( ! $date ) {
            return '-';
        }

        return \Date::format($date, 'datetime');
    }


}