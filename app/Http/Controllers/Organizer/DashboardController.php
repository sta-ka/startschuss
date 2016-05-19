<?php namespace App\Http\Controllers\Organizer;

use App\Http\Controllers\Controller;

/**
 * Class DashboardController
 *
 * @package App\Http\Controllers\Organizer
 */
class DashboardController extends Controller {

    /**
     * @return \Illuminate\View\View
     */
    public function index()
	{
		return view('organizer.dashboard.show');
	}

}