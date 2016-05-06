<?php namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use App\Models\Company\CompanyRepository as Companies;
use App\Models\Event\EventRepository as Events;
use App\Models\Misc\Log\InfoRepository as Infos;
use App\Models\Misc\Statistic\StatisticRepository as Statistic;
use App\Models\User\Login\LoginRepository as Logins;
use App\Models\Organizer\OrganizerRepository as Organizers;
use App\Models\User\UserRepository as Users;

/**
 * Class DashboardController
 *
 * @package App\Http\Controllers\Admin
 */
class DashboardController extends Controller {

    /**
     * @var Events
     */
    private $eventRepo;

    /**
     * @var Users
     */
    private $userRepo;

    /**
     * Constructor: inject dependencies.
     *
     * @param Events     $eventRepo
     * @param Users      $userRepo
     */
    public function __construct(Events $eventRepo, Users $userRepo)
	{
		$this->eventRepo 	 = $eventRepo;
		$this->userRepo 	 = $userRepo;
	}

	/**
	 * Redirect to 'Login overview' page.
     *
     * @return \Illuminate\Http\RedirectResponse
	 */
	public function index()
	{
		return redirect('admin/dashboard/logins');
	}

	/**
	 * Show all requested events.
     *
     * @return \Illuminate\Http\RedirectResponse
	 */
	public function requestedEvents()
	{
		$data['events'] = $this->eventRepo->getRequestedEvents();

		return view('admin.dashboard.news.requested_events', $data);
	}

	/**
	 * Display last 200 logins.
     *
     * @param Logins $loginRepo
     *
     * @return \Illuminate\View\View
	 */
	public function logins(Logins $loginRepo)
	{
		$data['logins'] = $loginRepo->getAll(200);

		return view('admin.dashboard.statistics.logins', $data);
	}

	/**
	 * Display login attempts.
     *
     * @return \Illuminate\View\View
	 */
	public function loginAttempts()
	{
		$data['login_attempts'] = $this->userRepo->getLoginAttempts();

		return view('admin.dashboard.statistics.login_attempts', $data);
	}

	/**
	 * Display logged data.
     *
     * @param Infos $infoRepo
     *
     * @return \Illuminate\View\View
	 */
	public function loggedData(Infos $infoRepo)
	{
		$data['logged_data'] = $infoRepo->getAll(200);

		return view('admin.dashboard.news.logged_data', $data);
	}

	/**
	 * Display overview of searches.
     *
     * @param Statistic $statisticRepo
     *
     * @return \Illuminate\View\View
	 */
	public function searches(Statistic $statisticRepo)
	{
		$data['searches'] = $statisticRepo->getSearches();
		$data['top_searches'] = $statisticRepo->getPopularSearches();

		return view('admin.dashboard.statistics.searches', $data);
	}

	/**
	 * Display overview of revision types.
     *
     * @return \Illuminate\View\View
	 */
	public function revisions()
	{
		return view('admin.dashboard.revisions.overview');
	}

	/**
	 * Display history of revisions to user table
     *
     * @return \Illuminate\View\View
	 */
	public function userRevisions()
	{
		$data['users'] 		= $this->userRepo->getAll();
		$data['user_list']  = $this->userRepo->lists('username', 'id');

		return view('admin.dashboard.revisions.usertable', $data);
	}

	/**
	 * Display history of revisions to event table
     *
     * @return \Illuminate\View\View
	 */
	public function eventRevisions()
	{
		$data['events'] 	= $this->eventRepo->getAll(true); // true = include soft-deleted events
		$data['user_list']  = $this->userRepo->lists('username', 'id');

		return view('admin.dashboard.revisions.eventtable', $data);
	}

	/**
	 * Display history of revisions to company table
     *
     * @param Companies $companyRepo
     *
     * @return \Illuminate\View\View
	 */
	public function companyRevisions(Companies $companyRepo)
	{
		$data['companies'] = $companyRepo->getAll(true); // true = include soft-deleted companies
		$data['user_list'] = $this->userRepo->lists('username', 'id');

		return view('admin.dashboard.revisions.companytable', $data);
	}

	/**
	 * Display history of revisions to organizer table
     *
     * @param Organizers $organizerRepo
     *
     * @return \Illuminate\View\View
	 */
	public function organizerRevisions(Organizers $organizerRepo)
	{
		$data['organizers'] = $organizerRepo->getAll(true); // true = include soft-deleted organizers
		$data['user_list']  = $this->userRepo->lists('username', 'id');

		return view('admin.dashboard.revisions.organizertable', $data);
	}

}