<?php namespace App\Http\Controllers\Applicant;

use App\Http\Controllers\Controller;

use App\Models\Misc\Region\RegionRepository as Regions;
use App\Models\Applicant\Application\ApplicationRepository as Applications;

/**
 * Class DashboardController
 *
 * @package App\Http\Controllers\Applicant
 */
class DashboardController extends Controller {

    /**
     * @param Regions $region
     * @param Applications $application
     *
     * @return \Illuminate\View\View
     */
	public function index(Regions $region, Applications $application)
	{
        $region_id = settings('region');

        $data['events'] = $region->getEventsInRegion($region_id, 5);
        $data['applications'] = $application->getAll(\Sentry::getUser()->getId());

		return view('applicant.dashboard.show', $data);
	}

}