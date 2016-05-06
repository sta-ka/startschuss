<?php namespace App\Http\Controllers\Organizer;

use App\Http\Controllers\Controller;

use App\Models\Applicant\ApplicantRepository as Applicants;
use App\Models\Applicant\Application\ApplicationRepository as Applications;
use App\Models\Event\EventRepository as Events;
use App\Models\User\UserRepository as Users;

use App\Services\Creator\ApplicationCreator;

use App\Http\Requests\Application\ArrangeInterviewRequest;

use Sentry;

/**
 * Class ApplicationsController
 *
 * @package App\Http\Controllers\Organizer
 */
class ApplicationsController extends Controller
{
    /**
     * @var Applications
     */
    private $applicationRepo;

    /**
     * @var Events
     */
    private $eventRepo;

    /**
     * Constructor: inject dependencies.
     *
     * @param Applications $applicationRepo
     * @param Events       $eventRepo
     */
    public function __construct(Applications $applicationRepo, Events $eventRepo)
    {
        $this->applicationRepo  = $applicationRepo;
        $this->eventRepo        = $eventRepo;

        // check if event belongs to user at all
        $this->middleware('ownership.event:all', ['except' => ['index']]);

        // check if application belongs to organizer user
        $this->middleware('ownership.organizer.application', ['except' => [
                                                                    'index',
                                                                    'event',
                                                                    'lockInterviews',
                                                                    'closeApplications',
                                                                    'eventInterviews'
                                                                ]
        ]);
    }

    /**
     * Overview -  Show all applications.
     *
     * @param Users $userRepo
     *
     * @return \Illuminate\View\View
     */
    public function index(Users $userRepo)
    {
        $data['events'] = $userRepo->getEventsHostingInterviews(Sentry::getUser()->getId(), 'organizer');

        return view('organizer.applications.events_overview', $data);
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
        $data['event'] = $this->eventRepo->findById($event_id);
        $data['applications'] = $this->eventRepo->getApplications($event_id);

        return view('organizer.applications.event_overview', $data);
    }

    /**
     * Lock all interview dates.
     *
     * @param int $event_id
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function lockInterviews($event_id)
    {
        $applications = $this->eventRepo->getApplications($event_id);

        // check if all applications are properly processed
        foreach ($applications as $application) {
            if ($application->time_of_interview == null && $application->accepted_by_company == true) {
                notify('error', 'interview_times_missing', false);
                return redirect('organizer/applications/event/' . $event_id);
            }
        }

        $event = $this->eventRepo->findById($event_id);
        $event->update(['interviews_locked' => true]);

        notify('success', 'interviews_locked', false);
        return redirect('organizer/applications/event/' . $event_id);
    }

    /**
     * Lock all interview dates.
     *
     * @param int $event_id
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function closeApplications($event_id)
    {
        $event = $this->eventRepo->findById($event_id);
        $event->update(['applications_closed' => true]);

        notify('success', 'applications_closed', false);
        return redirect('organizer/applications/event/' . $event_id);
    }

    /**
     * Detail page - Show single application.
     *
     * @param int $event_id
     * @param int $application_id
     *
     * @return \Illuminate\View\View
     */
    public function show($event_id, $application_id)
    {
        $data['event'] = $this->eventRepo->findById($event_id);
        $data['application'] = $this->applicationRepo->findById($application_id);

        return view('organizer.applications.profile.show', $data);
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

        $data['event'] = $this->eventRepo->findById($event_id);
        $data['applicant'] = $applicantRepo->findByUserId($applicant_id);

        return view('organizer.applications.profile.applicant', $data);
    }

    /**
     * Approve single application.
     *
     * @param int $event_id
     * @param int $application_id
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function approveApplication($event_id, $application_id)
    {
        $success = $this->applicationRepo->approveApplication($application_id);
        notify($success, 'application_approved');

        return redirect('organizer/applications/show/' . $event_id . '/' . $application_id);
    }

    /**
     * Disapprove single application.
     *
     * @param int $event_id
     * @param int $application_id
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function disapproveApplication($event_id, $application_id)
    {
        $success = $this->applicationRepo->disapproveApplication($application_id);
        notify($success, 'application_rejected');

        return redirect('organizer/applications/show/' . $event_id . '/' . $application_id);
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
        $data['event'] = $this->eventRepo->findById($event_id);
        $data['applications'] = $this->eventRepo->getApplications($event_id);

        return view('organizer.applications.event_interviews', $data);
    }

    /**
     * Delete date for an interview.
     *
     * @param int $event_id
     * @param int $application_id
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function deleteInterview($event_id, $application_id)
    {
        $application = $this->applicationRepo->findById($application_id);
        $event = $this->eventRepo->findById($event_id);

        if ($event->interviews_locked) { // redirect if interviews are locked
            return redirect('organizer/applications/show/' . $event_id . '/' . $application_id);
        }

        $success = $application->update(['time_of_interview' => null]);

        if ($success == false) {
            notify('error', 'interview_deleted');
            return redirect('organizer/applications/show/' . $event_id . '/' . $application_id);
        }

        event('log.event', [$event->name . ': Einzelgesprächstermin gelöscht.']);

        notify('success','interview_deleted');
        return redirect('organizer/applications/show/' . $event_id . '/' . $application_id);
    }

    /**
     * Arrange date for an interview.
     *
     * @param ArrangeInterviewRequest $request
     * @param int                     $event_id
     * @param    int                  $application_id
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function arrangeInterview(ArrangeInterviewRequest $request, $event_id, $application_id)
    {
        $event = $this->eventRepo->findById($event_id);

        $success = (new ApplicationCreator($this->applicationRepo))
                    ->arrangeInterview($request->all(), $application_id);

        if ($success == false) {
            notify('error', 'interview_arranged');
            return redirect('organizer/applications/show/' . $event_id . '/' . $application_id);
        }

        event('log.event', [$event->name . ': Einzelgesprächstermin vergeben.']);
        notify('success', 'interview_arranged');

        return redirect('organizer/applications/show/' . $event_id . '/' . $application_id);
    }

    /**
     * Delete date for an interview.
     *
     * @param int    $event_id
     * @param    int $application_id
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function rearrangeInterview($event_id, $application_id)
    {
        $application = $this->applicationRepo->findById($application_id);
        $event = $this->eventRepo->findById($event_id);

        if ($event->interviews_locked) {
            return redirect('organizer/applications/show/' . $event_id . '/' . $application_id);
        }

        $success = $application->update(['time_of_interview' => null]);

        if ($success == false) {
            notify('error', 'interview_deleted');
            return redirect('organizer/applications/show/' . $event_id . '/' . $application_id);
        }

        event('log.event', [$event->name . ': Einzelgesprächstermin gelöscht.']);

        notify('success', 'interview_deleted');
        return redirect('organizer/applications/show/' . $event_id . '/' . $application_id);
    }

}