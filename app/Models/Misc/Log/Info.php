<?php namespace App\Models\Misc\Log;

use Illuminate\Database\Eloquent\Model;

class Info extends Model {

    /**
     * The table associated with the model.
     *
     * @var string
     */
	public $table = 'logs';

    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = true;

    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $guarded = [];

}