<?php namespace App\Http\Controllers\Applicant;

use App\Http\Controllers\Controller;

use App\Models\Applicant\Application\ApplicationRepository as Applications;
use App\Models\Company\CompanyRepository as Companies;
use App\Models\Event\EventRepository as Events;
use App\Services\Creator\ApplicationCreator;

use App\Http\Requests\Application\ApplyForInterviewRequest;

/**
 * Class ApplicationsController
 *
 * @package App\Http\Controllers\Applicant
 */
class ApplicationsController extends Controller {

    /**
     * @var Applications
     */
    private $applicationRepo;

    /**
     * @var Companies
     */
    private $companyRepo;

    /**
     * @var Events
     */
    private $eventRepo;

    /**
     * @var \Cartalyst\Sentry\Users\UserInterface
     */
    private $user;

    /**
     * Constructor: inject dependencies and apply filters.
     *
     * @param Applications $applicationRepo
     * @param Events       $eventRepo
     * @param Companies    $companyRepo
     */
    public function __construct(Applications $applicationRepo, Events $eventRepo, Companies $companyRepo)
	{
		$this->applicationRepo  = $applicationRepo;
		$this->companyRepo 		= $companyRepo;
		$this->eventRepo 		= $eventRepo;

        $this->user = \Sentry::getUser();

		// check if user already applied for the company at the given event
		$this->middleware('check.application', ['only' => [
													    'applyForInterview',
													    'submitInterviewApplication'
													]
												]);

		// check if a company offers interview at an event
		$this->middleware('offers.applications', ['only' => [
                                                        'applyForInterview',
														'submitInterviewApplication'
													]
												]);

        // TODO check ownership
	}

	/**
	 * Overview: Events hosting interviews.
     *
     * @return \Illuminate\View\View
	 */
	public function index()
	{
		$data['events'] = $this->eventRepo->getEventsWithInterviews();

		return view('applicant.applications.apply', $data);
	}

	/**
	 * Show all applications by user.
     *
     * @return \Illuminate\View\View
	 */
	public function show()
	{
		$data['applications'] = $this->applicationRepo->getAll($this->user->getId());

		return view('applicant.applications.show', $data);
	}

	/**
	 * Show single application.
     *
     * @param int $application_id
     *
     * @return \Illuminate\View\View
	 */
	public function showSingle($application_id)
	{
		$data['application'] = $this->applicationRepo->getSingle($this->user->getId(), $application_id);

		return view('applicant.applications.profile.show', $data);
	}

	/**
	 * Show event and companies giving interviews at this event.
     *
     * @param int $event_id
     *
     * @return \Illuminate\View\View
	 */
	public function event($event_id)
	{
		$data['event'] 	 	= $this->eventRepo->findById($event_id);
		$data['companies'] 	= $this->companyRepo->getCompaniesGivingInterviews($this->user->getId(), $event_id);

		return view('applicant.applications.event', $data);
	}

	/**
	 * Apply for an interview at an event.
     *
     * @param int $event_id
     * @param int $company_id
     *
     * @return \Illuminate\View\View
	 */
	public function applyForInterview($event_id, $company_id)
	{
		$data['company'] = $this->companyRepo->findById($company_id);
		$data['event'] 	 = $this->eventRepo->findById($event_id);

		return view('applicant.applications.apply_for_interview', $data);
	}

	/**
	 * Submit application.
     *
     * @param ApplyForInterviewRequest $request
     * @param int $event_id
     * @param int $company_id
     *
     * @return \Illuminate\Http\RedirectResponse
	 */
	public function submitInterviewApplication(ApplyForInterviewRequest $request, $event_id, $company_id)
	{
		$success = (new ApplicationCreator($this->applicationRepo))
					->submitApplication($request->all(), $event_id, $company_id);

		if (! $success) {
            notify('error', 'application_created');

            return redirect('applicant/applications');
        }

        event('log.event', [$this->user->username .': Neue Bewerbung erstellt.']);
        notify('success', 'application_created');

        return redirect('applicant/applications');
	}

}