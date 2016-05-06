<?php namespace App\Http\Controllers\Frontend;

use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Routing\Controller;

use App\Models\Misc\Article\ArticleRepository as Articles;
use App\Models\Misc\City\CityRepository as Cities;
use App\Models\Event\EventRepository as Events;
use App\Models\Organizer\OrganizerRepository as Organizers;
use App\Models\Misc\Region\RegionRepository as Regions;
use App\Services\Mailers\EventMailer as EventMailer;

use App\Http\Requests\Event\CommitEventRequest;

use Input;

/**
 * Class EventsController
 *
 * @package App\Http\Controllers\Frontend
 */
class EventsController extends Controller {

    /**
     * @var Events
     */
    private $eventRepo;

    /**
     * @var Regions
     */
    private $regionRepo;

    /**
     * Constructor: inject dependencies.
     *
     * @param Events     $eventRepo
     * @param Regions    $regionRepo
     */
    public function __construct(Events $eventRepo, Regions $regionRepo)
	{
		$this->eventRepo  = $eventRepo;
		$this->regionRepo = $regionRepo;
	}

	/**
	 * Start page: Overview.
     *
     * @param Articles     $articleRepo
     * @param Organizers   $organizerRepo
     *
     * @return \Illuminate\View\View
	 */
	public function index(Articles $articleRepo, Organizers $organizerRepo)
	{
		$data['events']		= $this->eventRepo->getAllVisibleEvents(12);
		$data['organizers'] = $organizerRepo->getFeaturedOrganizers();
		$data['articles'] 	= $articleRepo->getFeatured(2);

		return view('start.overview', $data);
	}

	/**
	 * Events overview - Displays all events or search results if input is given.
     *
     * @return \Illuminate\View\View
	 */
	public function messekalender()
	{
		if (Input::has('stadt')) {
            event('log.statistics', ['search', Input::get('stadt')]);

			$data['events'] = $this->eventRepo->getResults(Input::get('stadt'));
		} else {
			$data['events'] = $this->eventRepo->getPaginatedEvents(10);
		}

		$data['regions'] = $this->regionRepo->getAll();

		return view('start.events', $data);
	}

	/**
	 * Display event info if it exists.
     *
     * @param string $slug
     *
     * @return \Illuminate\View\View
	 */
	public function messe($slug)
	{
        try {
            $data['event']	   = $this->eventRepo->findBySlug($slug);
            $data['events']	   = $this->regionRepo->getEventsInRegion($data['event']->region_id, 5);
            $data['companies'] = $this->eventRepo->getParticipatingCompanies($data['event']->id);

            return view('start.event', $data);
        } catch (ModelNotFoundException $e) {
			notify('error', 'event_not_found', false);
            return redirect()->route('messekalender');
        }
	}

	/**
	 * 'Events in region' page - Display events based on region given.
     *
     * @param string $slug
     *
     * @return \Illuminate\View\View
	 */
	public function messen($slug)
	{
        try {
            $data['regions'] = $this->regionRepo->getAll();
            $data['region']  = $this->regionRepo->findBySlug($slug);
            $data['events']  = $this->regionRepo->getEventsInRegion($data['region']->id, 10);

            return view('start.events_by_region', $data);
        } catch (ModelNotFoundException $e) {
			notify('error', 'region_not_found', false);
            return redirect()->route('messekalender');
        }
	}

	/**
	 * 'Events in city' page - Display events based on city given.
     *
     * @param string $slug
     * @param Cities $cityRepo
     *
     * @return \Illuminate\View\View
	 */
	public function messenIn($slug, Cities $cityRepo)
	{
        try {
            $data['city']    = $cityRepo->findBySlug($slug);
            $data['regions'] = $this->regionRepo->getAll();
            $data['events']  = $this->eventRepo->getResults($slug);

            return view('start.events_by_city', $data);
        } catch (ModelNotFoundException $e) {
			notify('error', 'city_not_found', false);
            return redirect()->route('messekalender');
        }
	}

	/**
	 * Display form to submit new event.
     *
     * @return \Illuminate\View\View
	 */
	public function neueMesse()
	{
		$data['regions'] = $this->regionRepo->lists('name', 'name');

		return view('start.misc.new_event', $data);
	}

	/**
	 * Process form to submit new event.
     *
     * @param CommitEventRequest $request
     *
     * @return \Illuminate\View\View
	 */
	public function messeEintragen(CommitEventRequest $request)
	{
        (new EventMailer)->newEvent($request->all()) // send mail to admin with event data
                         ->deliver();

		return redirect('home');
	}
}