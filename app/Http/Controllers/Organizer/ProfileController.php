<?php namespace App\Http\Controllers\Organizer;

use App\Http\Controllers\Controller;

use App\Models\User\UserRepository as Users;
use App\Models\Event\EventRepository as Events;
use App\Models\Misc\Region\RegionRepository as Regions;
use App\Models\Company\CompanyRepository as Companies;

use App\Http\Requests\Event\UploadLogoRequest;
use App\Http\Requests\Event\RequestEventRequest;
use App\Http\Requests\Event\UpdateProfileRequest;
use App\Http\Requests\Event\UpdateProgramRequest;
use App\Http\Requests\Event\UpdateContactsRequest;
use App\Http\Requests\Event\UpdateApplicationDeadlineRequest;

use Input;
use HTML;
use Request;
use Sentry;
use URL;

/**
 * Class ProfileController
 *
 * @package App\Http\Controllers\Organizer
 */
class ProfileController extends Controller {

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
     * @param Events    $eventRepo
     * @param Users     $userRepo
     */
    public function __construct(Events $eventRepo, Users $userRepo)
    {
        $this->eventRepo = $eventRepo;
        $this->userRepo = $userRepo;

        // check if event is an upcoming event and belongs to user
        $this->middleware('ownership.event', ['except' => ['index', 'newEvent', 'create']]);

        // check if event belongs to user at all
        $this->middleware('ownership.event:all', ['only' => ['newEvent', 'create']]);

        // check if user can request new events (maximum of 2 requested events at a time)
        $this->middleware('events.request', ['only' => ['newEvent', 'create']]);
    }

    /**
     * Show all events (upcoming and past) connected to the user.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $user = Sentry::getUser();

        $data['events']      = $this->userRepo->getEvents($user->getId());
        $data['past_events'] = $this->userRepo->getEvents($user->getId(), false);

        $data['requested_events'] = $this->eventRepo->getRequestedEvents($user->getId());

        return view('organizer.events.overview', $data);
    }

    /**
     * Request a new event.
     *
     * @param int $event_id
     * @param Regions $regionRepo
     *
     * @return \Illuminate\View\View
     */
    public function newEvent($event_id, Regions $regionRepo)
    {
        $data['event']   = $this->eventRepo->findById($event_id);
        $data['regions'] = $regionRepo->lists('name', 'id');

        return view('organizer.events.new', $data);
    }


    /**
     * Process requesting new event.
     *
     * @param RequestEventRequest $request
     * @param int                 $event_id
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function create(RequestEventRequest $request, $event_id)
    {
        $success = $request->persist($this->eventRepo, $event_id);
        notify($success, 'event_created');

        return redirect('organizer/profile');
    }

    /**
     * Show event profile.
     *
     * @param int $event_id
     *
     * @return \Illuminate\View\View
     */
    public function show($event_id)
    {
        $data['event'] = $this->eventRepo->findById($event_id);

        return view('organizer.events.profile.show', $data);
    }

    /**
     * Display 'Edit basic data' form.
     *
     * @param int $event_id
     *
     * @return \Illuminate\View\View
     */
    public function editBasics($event_id)
    {
        $data['event'] = $this->eventRepo->findById($event_id);

        return view('organizer.events.profile.edit_basics', $data);
    }

    /**
     * Process editing basic data.
     *
     * @param UpdateProfileRequest $request
     * @param int                  $event_id
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function updateBasics(UpdateProfileRequest $request, $event_id)
    {
        $request->persist($this->eventRepo, $event_id);

        return redirect('organizer/profile/' . $event_id . '/show');
    }

    /**
     * Display 'Edit program' form.
     *
     * @param int $event_id
     *
     * @return \Illuminate\View\View
     */
    public function editProgram($event_id)
    {
        $data['event'] = $this->eventRepo->findById($event_id);

        return view('organizer.events.profile.edit_program', $data);
    }

    /**
     * Process editing program.
     *
     * @param UpdateProgramRequest $request
     * @param int                  $event_id
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function updateProgram(UpdateProgramRequest $request, $event_id)
    {
        $request->persist($this->eventRepo, $event_id);

        return redirect('organizer/profile/' . $event_id . '/show');
    }

    /**
     * Display 'Edit contact' form.
     *
     * @param int $event_id
     *
     * @return \Illuminate\View\View
     */
    public function editContacts($event_id)
    {
        $data['event'] = $this->eventRepo->findById($event_id);

        return view('organizer.events.profile.edit_contacts', $data);
    }

    /**
     * Process editing contacts.
     *
     * @param UpdateContactsRequest $request
     * @param int                   $event_id
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function updateContacts(UpdateContactsRequest $request, $event_id)
    {
        $request->persist($this->eventRepo, $event_id);

        return redirect('organizer/profile/' . $event_id . '/show');
    }

    /**
     * Upload logo.
     *
     * @param int $event_id
     *
     * @return \Illuminate\View\View
     */
    public function editLogo($event_id)
    {
        $data['event'] = $this->eventRepo->findById($event_id);

        return view('organizer.events.profile.edit_logo', $data);
    }

    /**
     * Process logo upload.
     *
     * @param UploadLogoRequest $request
     * @param int               $event_id
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function updateLogo(UploadLogoRequest $request, $event_id)
    {
        $request->persist($this->eventRepo, $event_id);

        return redirect('organizer/profile/' . $event_id . '/edit-logo');
    }

    /**
     * Delete logo.
     *
     * @param int $event_id
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function deleteLogo($event_id)
    {
        $event = $this->eventRepo->findById($event_id);

        $filename = $event->logo;

        if (empty($filename)) {
            notify('error', 'logo_deleted');
            return redirect('organizer/profile/' . $event_id . '/edit-logo');
        }

        $event->update(['logo' => null]); // delete logo in the database

        $this->deleteFiles($filename);

        notify('success', 'logo_deleted');
        return redirect('organizer/profile/' . $event_id . '/edit-logo');
    }

    /**
     * Edit application deadline.
     *
     * @param UpdateApplicationDeadlineRequest $request
     * @param int                              $event_id
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function updateApplicationDeadline(UpdateApplicationDeadlineRequest $request, $event_id)
    {
        $request->persist($this->eventRepo, $event_id);

        return redirect('organizer/profile/' . $event_id . '/manage-interviews');
    }

    /**
     * Manage participants to an event.
     *
     * @param int $event_id
     * @param Companies $companyRepo,
     *
     * @return \Illuminate\View\View
     */
    public function manageParticipants($event_id, Companies $companyRepo)
    {
        $data['event'] = $this->eventRepo->findById($event_id);
        $data['companies'] = $companyRepo->getCompanies($event_id);

        return view('organizer.events.profile.manage_participants', $data);
    }

    /**
     * Add a company as participant to an event.
     *
     * @param int $event_id
     * @param int $company_id
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function addCompany($event_id, $company_id)
    {
        if (Request::ajax()) {
            $success = $this->eventRepo->addAsParticipant($event_id, $company_id);

            $success ?
                $data = json_encode([
                    'text' => 'Rückgangig machen',
                    'url' => URL::to('organizer/profile/remove-company/' . $event_id . '/' . $company_id)]) :
                $data = json_encode([
                    'text' => 'Als Teilnehmer hinzufügen',
                    'url' => URL::to('organizer/profile/add-company/' . $event_id . '/' . $company_id)]);

            return $data;
        }

        $success = $this->eventRepo->addAsParticipant($event_id, $company_id);

        notify($success, 'company_added');

        return redirect('organizer/profile/' . $event_id . '/manage-participants');
    }

    /**
     * Remove a company as participant from an event.
     *
     * @param int $event_id
     * @param int $company_id
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function removeCompany($event_id, $company_id)
    {
        $participant = $this->eventRepo->findParticipant($event_id, $company_id);

        if (Request::ajax()) {
            if (!isset($participant->pivot->created_at)) {
                $data = json_encode([
                    'text' => 'Als Teilnehmer hinzufügen',
                    'url' => URL::to('organizer/profile/add-company/' . $event_id . '/' . $company_id)]);
            } elseif (strtotime($participant->pivot->created_at) + 60 * 5 < time()) {
                $data = '-';
            } else {
                $success = $this->eventRepo->removeAsParticipant($event_id, $company_id);

                $success ?
                    $data = json_encode([
                        'text' => 'Als Teilnehmer hinzufügen',
                        'url' => URL::to('organizer/profile/add-company/' . $event_id . '/' . $company_id)]) :
                    $data = json_encode([
                        'text' => 'Rückgangig machen',
                        'url' => URL::to('organizer/profile/remove-company/' . $event_id . '/' . $company_id)]);
            }

            return $data;
        }

        if ( ! isset($participant->pivot->created_at) || strtotime($participant->pivot->created_at) + 60 * 5 < time()) {
            notify('error', 'company_removed');
            return redirect('organizer/profile/' . $event_id . '/manage-participants');
        }

        $success = $this->eventRepo->removeAsParticipant($event_id, $company_id);
        notify($success, 'company_removed');

        return redirect('organizer/profile/' . $event_id . '/manage-participants');
    }

    /**
     * Manage interviews at an event.
     *
     * @param int $event_id
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function manageInterviews($event_id)
    {
        $event = $this->eventRepo->findById($event_id);

        if ($event->interviews) { // checks if event hosts interviews
            $data['event'] = $this->eventRepo->findById($event_id);
            $data['companies'] = $this->eventRepo->getParticipatingCompanies($event_id);

            return view('organizer.events.profile.manage_interviews', $data);
        }

        return redirect('organizer/profile/' . $event_id . '/show');
    }

    /**
     * Add an interview tag to a participant.
     *
     * @param int $event_id
     * @param int $company_id
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function addInterview($event_id, $company_id)
    {
        $event = $this->eventRepo->findById($event_id);

        if ($event->interviews) { // checks if event hosts interviews
            if (Request::ajax()) {
                $success = $this->eventRepo->addInterviewTag($event_id, $company_id);

                $success ?
                    $data = json_encode([
                        'text' => 'Rückgangig machen',
                        'url' => URL::to('organizer/profile/remove-interview/' . $event_id . '/' . $company_id)]) :
                    $data = json_encode([
                        'text' => 'Hinzufügen',
                        'url' => URL::to('organizer/profile/add-interview/' . $event_id . '/' . $company_id)]);

                return $data;
            }

            $success = $this->eventRepo->addInterviewTag($event_id, $company_id);
            notify($success, 'company_added');

            return redirect('organizer/profile/' . $event_id . '/manage-interviews');
        }

        return redirect('organizer/profile/' . $event_id . '/show');
    }

    /**
     * Remove interview tag from a participant.
     *
     * @param int $event_id
     * @param int $company_id
     *
     * @return mixed
     */
    public function removeInterview($event_id, $company_id)
    {
        $participant = $this->eventRepo->findParticipant($event_id, $company_id);

        if (Request::ajax()) {
            if (!isset($participant->pivot->interview)) {
                $data = HTML::link('organizer/profile/add-interview/' . $event_id . '/' . $company_id, 'Hinzufügen');
            } elseif (strtotime($participant->pivot->updated_at) + 60 * 5 < time()) {
                $data = '-';
            } else {
                $success = $this->eventRepo->removeInterviewTag($event_id, $company_id);

                $success ?
                    $data = json_encode([
                        'text' => 'Hinzufügen',
                        'url' => URL::to('organizer/profile/add-interview/' . $event_id . '/' . $company_id)]) :
                    $data = json_encode([
                        'text' => 'Rückgangig machen',
                        'url' => URL::to('organizer/profile/remove-interview/' . $event_id . '/' . $company_id)]);
            }

            return $data;
        }

        if (!isset($participant->pivot->interview) || strtotime($participant->pivot->updated_at) + 60 * 5 < time()) {
            notify('error', 'company_removed');
            return redirect('organizer/profile/' . $event_id . '/manage-interviews');
        }

        $success = $this->eventRepo->removeInterviewTag($event_id, $company_id);
        notify($success, 'company_removed');

        return redirect('organizer/profile/' . $event_id . '/manage-interviews');
    }

    /**
     * Add a comment to a participating company.
     *
     * @param int $event_id
     * @param int $company_id
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function addComment($event_id, $company_id)
    {
        $event = $this->eventRepo->findById($event_id);

        if ($event->interviews) { // checks if event hosts interviews
            $success = $this->eventRepo->addComment($event_id, $company_id, Input::get('comment'));

            if (Request::ajax()) {
                $success ?
                    $data = Input::get('comment') :
                    $data = 'error';

                return $data;
            }

            notify($success, 'comment_added');

            return redirect('organizer/profile/' . $event_id . '/manage-interviews');
        }
    }

    /**
     * Delete files
     *
     * @param $filename
     */
    private function deleteFiles($filename)
    {
        \File::delete('uploads/logos/original/' . $filename);
        \File::delete('uploads/logos/small/' . $filename);
    }
}