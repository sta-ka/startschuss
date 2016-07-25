<?php namespace App\Http\Controllers\Company;

use App\Http\Controllers\Controller;

use App\Models\User\UserRepository as Users;
use App\Models\Event\EventRepository as Events;
use App\Models\Applicant\ApplicantRepository as Applicants;
use App\Models\Applicant\Application\ApplicationRepository as Applications;

use Sentry;

/**
 * Class ApplicationsController
 *
 * @package App\Http\Controllers\Company
 */
class ApplicationsController extends Controller {

    /**
     * @var Applications
     */
    private $applicationRepo;

    /**
     * @var Events
     */
    private $eventRepo;

    /**
     * @var Users
     */
    private $userRepo;

    /**
     * Constructor: inject dependencies and apply filters.
     *
     * @param Applications $applicationRepo
     * @param Events       $eventRepo
     * @param Users        $userRepo
     */
    public function __construct(Applications $applicationRepo, Events $eventRepo, Users $userRepo)
	{
        $this->applicationRepo  = $applicationRepo;
        $this->eventRepo        = $eventRepo;
        $this->userRepo         = $userRepo;

        // check if user is linked to a company
        $this->middleware('check.company');

		// check if application 'belongs' to company user
		$this->middleware('ownership.company.application', ['only' => [
																'applicant',
																'show',
																'acceptApplication',
																'rejectApplication'
															]
														]);
	}

	/**
	 * Show all events for company which offer interviews.
     *
     * @return \Illuminate\View\View
	 */
	public function index()
	{
		$data['events'] = $this->userRepo->getEventsHostingInterviews(Sentry::getUser()->getId(), 'company');

		return view('company.applications.events_overview', $data);
	}

	/**
	 * Show all applications for a single event.
     *
     * @param int $event_id
     *
     * @return \Illuminate\View\View
	 */
	public function event($event_id)
	{
		$data['event']	      = $this->eventRepo->findById($event_id);
		$data['applications'] = $this->userRepo->getApplicationsForCompany(Sentry::getUser()->getId(), $event_id);

		return view('company.applications.event_overview', $data);
	}

	/**
	 * Show all interview dates for an event.
     *
     * @param int $event_id
     *
     * @return \Illuminate\View\View
	 */
	public function eventInterviews($event_id)
	{
		$data['event']	      = $this->eventRepo->findById($event_id);
		$data['applications'] = $this->userRepo->getApplicationsForCompany(Sentry::getUser()->getId(), $event_id);

		return view('company.applications.event_interviews', $data);
	}

	/**
	 * Show single application.
	 * (Application must belong to the company user -> see filters)
     *
     * @param int $event_id
     * @param int $application_id
     *
     * @return \Illuminate\View\View
	 */
	public function show($event_id, $application_id)
	{
		$data['event']	     = $this->eventRepo->findById($event_id);
		$data['application'] = $this->applicationRepo->findById($application_id);

		return view('company.applications.profile.show', $data);
	}

	/**
	 * Show applicant.
     *
     * @param int $event_id
     * @param int $application_id
     * @param Applicants $applicantRepo
     *
     * @return \Illuminate\View\View
	 */
	public function applicant($event_id, $application_id, Applicants $applicantRepo)
	{
		$applicant_id = $this->applicationRepo->findById($application_id)->applicant_id;

		$data['event'] 		 = $this->eventRepo->findById($event_id);
		$data['applicant']	 = $applicantRepo->findByUserId($applicant_id);

		return view('company.applications.profile.applicant', $data);
	}

	/**
	 * Accept application.
     *
     * @param int $event_id
     * @param int $application_id
     *
     * @return \Illuminate\Http\RedirectResponse
	 */
	public function acceptApplication($event_id, $application_id)
	{
		$success = $this->applicationRepo->acceptApplication($application_id);
		notify($success, 'application_accepted');

		return redirect('company/applications/show/' . $event_id . '/' . $application_id);
	}

	/**
	 * Reject application.
     *
     * @param int $event_id
     * @param int $application_id
     *
     * @return \Illuminate\Http\RedirectResponse
	 */
	public function rejectApplication($event_id, $application_id)
	{
		$success = $this->applicationRepo->rejectApplication($application_id);
		notify($success, 'application_rejected');

		return redirect('company/applications/show/' . $event_id . '/' . $application_id);
	}


}