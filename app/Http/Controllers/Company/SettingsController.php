<?php namespace App\Http\Controllers\Company;

use App\Http\Controllers\BaseSettingsController;

/**
 * Class SettingsController
 *
 * @package App\Http\Controllers\Company
 */
class SettingsController  extends BaseSettingsController {

    /**
     * Type of user
     *
     * @var string
     */
    protected $user_type = 'company';

}