<?php namespace App\Models\User\Login;

use App\Models;
use App\Presenters\DatePresenter;
use Illuminate\Database\Eloquent\Model;

class Login extends Model {

    use DatePresenter;

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
		return $this->hasOne(Models\User\User::class, 'id', 'user_id');
	}

}