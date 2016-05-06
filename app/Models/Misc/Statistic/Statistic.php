<?php namespace App\Models\Misc\Statistic;

use App\Presenters\DatePresenter;
use Illuminate\Database\Eloquent\Model;

class Statistic extends Model {

    use DatePresenter;

    /**
     * The table associated with the model.
     *
     * @var string
     */
	public $table = 'page_statistics';

    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $guarded = [];

}