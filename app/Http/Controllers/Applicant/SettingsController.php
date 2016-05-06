<?php namespace App\Http\Controllers\Applicant;

use App\Http\Controllers\BaseSettingsController;
use App\Http\Requests\Applicant\UpdateOptionsRequest;
use App\Models\Misc\Region\RegionRepository as Regions;

/**
 * Class SettingsController
 *
 * @package App\Http\Controllers\Applicant
 */
class SettingsController  extends BaseSettingsController {

    /**
     * Type of user
     *
     * @var string
     */
    protected $user_type = 'applicant';

    /**
     * @param Regions $region
     *
     * @return \Illuminate\View\View
     */
    public function options(Regions $region){
        $data['regions'] = $region->lists('name', 'id')->prepend('-');

        return view('applicant.settings.options', $data);
    }


    public function updateOptions(UpdateOptionsRequest $request){
        settings()->region = $request->get('region_id');

        dd('done');
    }

}