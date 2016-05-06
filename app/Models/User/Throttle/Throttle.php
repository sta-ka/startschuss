<?php namespace App\Models\User\Throttle;

use Illuminate\Database\Eloquent\Model;

use Date;

class Throttle extends Model {

    /**
     * The table associated with the model.
     *
     * @var string
     */
	protected $table = 'throttle';

/*
|--------------------------------------------------------------------------
|       Accessors and Mutators
|--------------------------------------------------------------------------
*/

    /**
     * Get 'last_attempt_at' attribute.
     *
     * @param $date
     *
     * @return bool|string
     */
    public function getLastAttemptAtAttribute($date)
    {
        if ( ! $date) {
            return '-';
        }

        return Date::format($date, 'datetime');
    }

}