<?php namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\Creator\EventCreator;

use App\Models\Company\CompanyRepository as Companies;
use App\Models\Event\EventRepository as Events;
use App\Models\Organizer\OrganizerRepository as Organizers;
use App\Models\Misc\Audience\AudienceRepository as Audiences;
use App\Models\Misc\Region\RegionRepository as Regions;
use App\Models\User\UserRepository as Users;

use App\Http\Requests\Event\CreateEventRequest;
use App\Http\Requests\Event\UpdateGeneralDataRequest;
use App\Http\Requests\Event\UpdateProfileRequest;
use App\Http\Requests\Event\UpdateProgramRequest;
use App\Http\Requests\Event\UpdateContactsRequest;
use App\Http\Requests\Event\UpdateSeoDataRequest;
use App\Http\Requests\Event\UploadLogoRequest;

use Input;
use Request;
use Sentry;
use URL;

/**
 * Class EventsController
 *
 * @package App\Http\Controllers\Admin
 */
class EventsController extends Controller {

    /**
     * @var Companies
     */
    private $companyRepo;

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
     * @param Companies  $companyRepo
     * @param Events     $eventRepo
     * @param Users      $userRepo
     */
    public function __construct(Companies $companyRepo, Events $eventRepo, Users $userRepo)
	{
		$this->companyRepo = $companyRepo;
		$this->eventRepo = $eventRepo;
		$this->userRepo = $userRepo;
	}

	/**
	 * Events overview.
     *
     * @return \Illuminate\View\View
     */
	public function index()
	{
		$data['events']     = $this->eventRepo->getAll(true); // true = include soft deleted events
		$data['duplicates'] = $this->eventRepo->getDuplicateEvents();

		return view('admin.events.show', $data);
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
		$data['users_list'] = $this->userRepo->lists('username', 'id', 2); // 2 = organizer group

		if ($data['event']->user_id) { // if event is linked to a user
            $data['user'] = $this->userRepo->findById($data['event']->user_id);
        }

		return view('admin.events.profile.show', $data);
	}

	/**
	 * Display 'New event' form
	 * optionally use old event information as a template.
     *
     * @param int|bool $event_id
     * @param Organizers $organizerRepo
     * @param Regions $regionRepo
     *
     * @return \Illuminate\View\View
	 */
	public function newEvent(Organizers $organizerRepo, Regions $regionRepo, $event_id = false)
	{
        $data['organizers']	= $organizerRepo->lists('name', 'id');
        $data['regions']	= $regionRepo->lists('name', 'id');

		if ($event_id) { // if event_id is given get data for this event
            $data['event'] = $this->eventRepo->findById($event_id);
        }

		return view('admin.events.new', $data);
	}

	/**
	 * Create event.
     *
     * @param CreateEventRequest $request
     *
     * @return \Illuminate\Http\RedirectResponse
	 */
	public function createEvent(CreateEventRequest $request)
	{
		$success = (new EventCreator($this->eventRepo))
					->createEvent($request->all());

		notify($success, 'event_created');

		return redirect('admin/events');
	}

	/**
	 * Accept an requested event.
     *
     * @param int $event_id
     *
     * @return \Illuminate\Http\RedirectResponse
	 */
	public function acceptRequest($event_id)
	{
		$this->eventRepo->findById($event_id)
		    ->update(['requested_by' => null]);

		return redirect('admin/events/'. $event_id .'/show');
	}

	/**
	 * Link an event to a user.
     *
     * @param int $event_id
     *
     * @return \Illuminate\Http\RedirectResponse
	 */
	public function addLinkage($event_id)
	{
		$user_id = Input::get('user_id');

		$user = Sentry::findUserByID($user_id);

		// if user is not in group 'organizer' -> redirect back
		if (! $user->inGroup(Sentry::findGroupByName('organizer'))) {
			notify('error', 'profile_update');
            return redirect('admin/events/'. $event_id .'/show');
		}

		$event = $this->eventRepo->findById($event_id);
		$event->update(['user_id' => $user_id]);

		return redirect('admin/events/'. $event_id .'/show');
	}

	/**
	 * Delete linkage between event and user.
     *
     * @param int $event_id
     *
     * @return \Illuminate\Http\RedirectResponse
	 */
	public function deleteLinkage($event_id)
	{
		$event = $this->eventRepo->findById($event_id);
		$event->update(['user_id' => null]);

		return redirect('admin/events/'. $event_id .'/show');
	}

	/**
	 * Display 'Edit general data' form.
     *
     * @param int $event_id
     * @param Organizers $organizerRepo
     * @param Regions $regionRepo
     *
     * @return \Illuminate\View\View
	 */
	public function editGeneralData($event_id, Organizers $organizerRepo, Regions $regionRepo)
	{
		$data['event']      = $this->eventRepo->findById($event_id);

		$data['regions']	= $regionRepo->lists('name', 'id');
		$data['organizers']	= $organizerRepo->lists('name', 'id');

		return view('admin.events.profile.edit_general_data', $data);
	}

	/**
	 * Process editing general data.
     *
     * @param UpdateGeneralDataRequest $request
     * @param int $event_id
     *
     * @return \Illuminate\Http\RedirectResponse
	 */
	public function updateGeneralData(UpdateGeneralDataRequest $request, $event_id)
	{
		(new EventCreator($this->eventRepo))
        	->editGeneralData($request->all(), $event_id);

		return redirect('admin/events/'. $event_id .'/show');
	}

	/**
	 * Display 'Edit event profile' form.
     *
     * @param int $event_id
     * @param Audiences $audienceRepo
     *
     * @return \Illuminate\View\View
	 */
	public function editProfile($event_id, Audiences $audienceRepo)
	{	
		$data['event']		= $this->eventRepo->findById($event_id);
		$data['audience']	= explode(', ', $data['event']->audience);
		$data['audiences']	= $audienceRepo->lists('name', 'name');
		
		return view('admin.events.profile.edit_profile', $data);
	}

	/**
	 * Process editing event profile.
     *
     * @param UpdateProfileRequest $request
     * @param int $event_id
     *
     * @return \Illuminate\Http\RedirectResponse
	 */
	public function updateProfile(UpdateProfileRequest $request, $event_id)
	{
		(new EventCreator($this->eventRepo))
        	->editProfile($request->all(), $event_id);

		return redirect('admin/events/'. $event_id .'/show');
	}

	/**
	 * Display 'Edit event program' form.
     *
     * @param int $event_id
     *
     * @return \Illuminate\View\View
	 */
	public function editProgram($event_id)
	{
		$data['event'] = $this->eventRepo->findById($event_id);
		
		return view('admin.events.profile.edit_program', $data);
	}

	/**
	 * Process editing event program.
     *
     * @param UpdateProgramRequest $request
     * @param int $event_id
     *
     * @return \Illuminate\Http\RedirectResponse
	 */
	public function updateProgram(UpdateProgramRequest $request, $event_id)
	{
		(new EventCreator($this->eventRepo))
        	->editProgram($request->all(), $event_id);

		return redirect('admin/events/'. $event_id .'/show');
	}

	/**
	 * Display 'Edit event contacts' form.
     *
     * @param int $event_id
     *
     * @return \Illuminate\View\View
	 */
	public function editContacts($event_id)
	{
		$data['event'] = $this->eventRepo->findById($event_id);
		
		return view('admin.events.profile.edit_contacts', $data);
	}

	/**
	 * Process editing event contacts.
     *
     * @param UpdateContactsRequest $request
     * @param int $event_id
     *
     * @return \Illuminate\Http\RedirectResponse
	 */
	public function updateContacts(UpdateContactsRequest $request, $event_id)
	{
		(new EventCreator($this->eventRepo))
        	->editContacts($request->all(), $event_id);

		return redirect('admin/events/'. $event_id .'/show');
	}

	/**
	 * Display 'Edit SEO data' form.
     *
     * @param int $event_id
     *
     * @return \Illuminate\View\View
	 */
	public function editSeoData($event_id)
	{
		$data['event'] = $this->eventRepo->findById($event_id);

		return view('admin.events.profile.edit_seo_data', $data);
	}

	/**
	 * Process editing SEO data.
     *
     * @param UpdateSeoDataRequest $request
     * @param int $event_id
     *
     * @return \Illuminate\Http\RedirectResponse
	 */
	public function updateSeoData(UpdateSeoDataRequest $request, $event_id)
	{
		(new EventCreator($this->eventRepo))
        	->editSeoData($request->all(), $event_id);

		return redirect('admin/events/'. $event_id .'/show');
	}

	/**
	 * Display 'Edit event logo' form.
     *
     * @param int $event_id
     *
     * @return \Illuminate\View\View
	 */
	public function editLogo($event_id)
	{
		$data['event'] = $this->eventRepo->findById($event_id);
		
		return view('admin.events.profile.edit_logo', $data);
	}

	/**
	 * Upload logo.
     *
     * @param UploadLogoRequest $request
     * @param int $event_id
     *
     * @return \Illuminate\Http\RedirectResponse
	 */
	public function updateLogo(UploadLogoRequest $request, $event_id)
	{
		(new EventCreator($this->eventRepo))
			->processLogo($event_id);

		return redirect('admin/events/'. $event_id .'/edit-logo');
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
            return redirect('admin/events/' . $event_id . '/edit-logo');
        }

        $this->deleteLogoFile($event);

        notify('success', 'logo_deleted');
        return redirect('admin/events/' . $event_id . '/edit-logo');
	}

	/**
	 * Toggle visibility status of event.
     *
     * @param int $event_id
     *
     * @return \Illuminate\Http\RedirectResponse
	 */
	public function changeStatus($event_id)
	{
		$event = $this->eventRepo->findById($event_id);

		// get status of visible
		$visible = $event->visible;
		
		$event->update(['visible' => ! $visible]);

		return back();
	}

	/**
	 * Show companies and manage participants for an event.
     *
     * @param int $event_id
     *
     * @return \Illuminate\View\View
	 */
	public function manageParticipants($event_id)
	{
		$data['event']      = $this->eventRepo->findById($event_id);
		$data['companies']	= $this->companyRepo->getCompanies($event_id);

		return view('admin.events.profile.manage_participants', $data);
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
		$data['event'] 		  = $this->eventRepo->findById($event_id);
		$data['applications'] = $this->eventRepo->getApplications($event_id);

		return view('admin.events.profile.interviews', $data);
	}

	/**
	 * Add company as participant to an event.
     *
     * @param int $event_id
     * @param int $company_id
     *
     * @return mixed
	 */
	public function addCompany($event_id, $company_id)
	{
		$success = $this->eventRepo->addAsParticipant($event_id, $company_id);

		if (Request::ajax()) {
/*			$success ?
				$data = Html::link('admin/events/remove-company/'. $event_id .'/'.$company_id, 'Als Teilnehmer löschen') :
				$data = Html::link('admin/events/add-company/'. $event_id .'/'.$company_id, 'Als Teilnehmer hinzufügen');*/
			$success ?
				$data = json_encode([
					'text' => 'Als Teilnehmer löschen', 
					'url' => URL::to('admin/events/remove-company/'. $event_id .'/'.$company_id)]) :
				$data = json_encode([
					'text' => 'Als Teilnehmer hinzufügen',
					'url' => Url::to('admin/events/add-company/'. $event_id .'/'.$company_id)]);

			return $data;
		}

		notify($success, 'company_added');

        return redirect('admin/events/' . $event_id . '/manage-participants');
	}

	/**
	 * Remove company as participant from an event.
     *
     * @param int $event_id
     * @param int $company_id
     *
     * @return mixed
     */
	public function removeCompany($event_id, $company_id)
	{
		$success = $this->eventRepo->removeAsParticipant($event_id, $company_id);

		if (Request::ajax()) {
			/*$success ?
				$data = Html::link('admin/events/add-company/'. $event_id .'/'.$company_id, 'Als Teilnehmer hinzufügen') :
				$data = Html::link('admin/events/remove-company/'. $event_id .'/'.$company_id, 'Als Teilnehmer löschen');*/

			$success ?
				$data = json_encode([
					'text' => 'Als Teilnehmer hinzufügen', 
					'url' => URL::to('admin/events/add-company/'. $event_id .'/'.$company_id)]) :
				$data = json_encode([
					'text' => 'Als Teilnehmer löschen',
					'url' => Url::to('admin/events/remove-company/'. $event_id .'/'.$company_id)]);

			return $data;
		}

        notify($success, 'company_removed');

        return redirect('admin/events/' . $event_id . '/manage-participants');
	}

	/**
	 * Show participants and manage interviews for an event.
     *
     * @param int $event_id
     *
     * @return \Illuminate\View\View
     */
	public function manageInterviews($event_id)
	{
		$data['event']		= $this->eventRepo->findById($event_id);
		$data['companies']	= $this->eventRepo->getParticipatingCompanies($event_id);

		return view('admin.events.profile.manage_interviews', $data);
	}

	/**
	 * Add interview tag to a participant of an event.
     *
     * @param int $event_id
     * @param int $company_id
     *
     * @return mixed
	 */
	public function addInterview($event_id, $company_id)
	{
		$success = $this->eventRepo->addInterviewTag($event_id, $company_id);

		if (Request::ajax()) {
			$success ?
				$data = json_encode([
					'text' => 'Löschen', 
					'url' => URL::to('admin/events/remove-interview/'. $event_id .'/'.$company_id)]) :
				$data = json_encode([
					'text' => 'Hinzufügen',
					'url' => Url::to('admin/events/add-interview/'. $event_id .'/'.$company_id)]);

			return $data;
		}

		notify($success, 'company_added');

        return redirect('admin/events/' . $event_id . '/manage-interviews');
	}

	/**
	 * Remove interview tag from a participant of an event.
     *
     * @param int $event_id
     * @param int $company_id
     *
     * @return mixed
	 */
	public function removeInterview($event_id, $company_id)
	{
		$success = $this->eventRepo->removeInterviewTag($event_id, $company_id);

		if (Request::ajax()) {
			$success ?
				$data = json_encode([
					'text' => 'Hinzufügen', 
					'url' => URL::to('admin/events/add-interview/'. $event_id .'/'.$company_id)]) :
				$data = json_encode([
					'text' => 'Löschen',
					'url' => Url::to('admin/events/remove-interview/'. $event_id .'/'.$company_id)]);

			return $data;
        }

		notify($success, 'company_removed');

        return redirect('admin/events/' . $event_id . '/manage-interviews');
	}

	/**
	 * Delete event - Soft delete is enabled.
     *
     * @param int $event_id
     *
     * @return \Illuminate\Http\RedirectResponse
	 */
	public function delete($event_id)
	{
		$event = $this->eventRepo->findById($event_id);

		// check if event is soft deleted
		if (! $event->deleted_at) {
			$success = $event->delete(); // soft-delete event
			notify($success, 'event_delete');

            return redirect('admin/events');
        }

        $event->forceDelete();

        if ($event->logo) {
            $this->deleteLogoFile($event);
        }

        // delete entries from participants table
        $event->participants()->detach();

        notify('success', 'event_delete');
        return redirect('admin/events');
	}

	/**
	 * Restore event - Restore soft deleted event.
     *
     * @param int $event_id
     *
     * @return \Illuminate\Http\RedirectResponse
	 */
	public function restore($event_id)
	{
		$event = $this->eventRepo->findById($event_id);

		if ($event->deleted_at) {
            $event->restore();
        }

		return redirect('admin/events/show/'.$event_id);
	}

    /**
     * Delete logo from database and in filesystem.
     *
     * @param $event
     */
    private function deleteLogoFile($event)
    {
        $filename = $event->logo;

        // delete logo in the database
        $event->update(['logo' => null]);

        // delete files
        \File::delete('uploads/logos/original/' . $filename);
        \File::delete('uploads/logos/small/' . $filename);
    }
}