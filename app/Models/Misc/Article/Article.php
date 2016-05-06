<?php namespace App\Models\Misc\Article;

use App\Models\NotifierTrait;
use Illuminate\Database\Eloquent\Model;

class Article extends Model {

    use NotifierTrait;

    public static $notfierMsgKey = 'profile_update';

    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
	protected $guarded = [];

/*
|--------------------------------------------------------------------------
|       Scopes
|--------------------------------------------------------------------------
*/

	public function scopeActive($query) {
		return $query->where('active', 1);
	}

	public function scopeLatest($query) {
		return $query->orderBy('created_at', 'desc');
	}

}