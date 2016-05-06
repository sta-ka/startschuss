<?php namespace App\Http\Controllers\Company;

use App\Http\Controllers\Controller;

/**
 * Class DashboardController
 *
 * @package App\Http\Controllers\Company
 */
class DashboardController extends Controller {

    /**
     * @return \Illuminate\View\View
     */
    public function index()
	{
		return view('company.dashboard.show');
	}

}