<?php namespace App\Http\Controllers\Applicant;

use App\Http\Controllers\Controller;
use App\Models\Applicant\Application\ApplicationRepository;
use App\Models\Misc\Region\RegionRepository;

/**
 * Class DashboardController
 *
 * @package App\Http\Controllers\Applicant
 */
class DashboardController extends Controller {

    /**
     * @param RegionRepository $region
     * @param ApplicationRepository $application
     *
     * @return \Illuminate\View\View
     */
	public function index(RegionRepository $region, ApplicationRepository $application)
	{
        $region_id = settings('region');

        $data['events'] = $region->getEventsInRegion($region_id, 5);
        $data['applications'] = $application->getAll(\Sentry::getUser()->getId());

		return view('applicant.dashboard.show', $data);
	}

}