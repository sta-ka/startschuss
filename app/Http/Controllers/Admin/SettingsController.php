<?php namespace App\Http\Controllers\Admin;

use App\Http\Controllers\BaseSettingsController;


/**
 * Class SettingsController
 *
 * @package App\Http\Controllers\Admin
 */
class SettingsController extends BaseSettingsController {

    /**
     * Type of user.
     *
     * @var string
     */
    protected $user_type = 'admin';
	
}