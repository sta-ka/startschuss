<?php namespace App\Http\Controllers\Frontend;

use Illuminate\Routing\Controller;

use App\Models\Misc\Article\ArticleRepository as Articles;
use App\Models\Misc\City\CityRepository as Cities;
use App\Models\Event\EventRepository as Events;
use App\Models\Organizer\OrganizerRepository as Organizers;
use App\Models\Misc\Region\RegionRepository as Regions;

use URL;

/**
 * Class MiscController
 *
 * @package App\Http\Controllers\Frontend
 */
class MiscController extends Controller {

    /**
     * @var Articles
     */
    private $articleRepo;

    /**
     * @var Cities
     */
    private $cityRepo;

    /**
     * @var Events
     */
    private $eventRepo;

    /**
     * @var Organizers
     */
    private $organizerRepo;

    /**
     * @var Regions
     */
    private $regionRepo;

    /**
     * Default timestamp.
     *
     * @var string
     */
    private $default_timestamp = '2016-04-17';

    /**
     * Constructor: inject dependencies.
     *
     * @param Articles   $articleRepo
     * @param Cities     $cityRepo
     * @param Events     $eventRepo
     * @param Organizers $organizerRepo
     * @param Regions    $regionRepo
     */
    public function __construct(Articles $articleRepo, Cities $cityRepo, Events $eventRepo, Organizers $organizerRepo, Regions $regionRepo)
	{
		$this->articleRepo 	 = $articleRepo;
		$this->cityRepo 	 = $cityRepo;
		$this->eventRepo 	 = $eventRepo;
		$this->organizerRepo = $organizerRepo;
		$this->regionRepo 	 = $regionRepo;
	}
	
	/**
	 * Display imprint.
     *
     * @return \Illuminate\View\View
	 */
	public function imprint()
	{
		return view('start.misc.imprint');
	}

	/**
	 * Create XML sitemap.
	 */
	public function showXMLSitemap()
	{
		$sitemap = app('sitemap');

		$event 		= $this->eventRepo->getLastModifiedEvent();
		$organizer 	= $this->organizerRepo->getLastModifiedOrganizer();
		$article 	= $this->articleRepo->getLastModifiedArticle();

		// Add static pages
		$sitemap->add(URL::to('home'), $this->getIsoTimestamp($event), '1.0', 'daily');
		$sitemap->add(URL::to('jobmessekalender'), $this->getIsoTimestamp($event), '0.7', 'daily');
		$sitemap->add(URL::to('veranstalterdatenbank'), $this->getIsoTimestamp($organizer), '0.7', 'monthly');
		$sitemap->add(URL::to('karriereratgeber'), $this->getIsoTimestamp($article), '0.7', 'weekly');
		$sitemap->add(URL::to('login'), $this->getIsoTimestamp(), '0.2', 'monthly');
		$sitemap->add(URL::to('jobmesse-eintragen'), $this->getIsoTimestamp(), '0.2', 'monthly');
		$sitemap->add(URL::to('kontakt'), $this->getIsoTimestamp(), '0.2', 'monthly');

        // Add dynamic pages
        $this->addEventPages($sitemap);
        $this->addEventsInRegionPages($sitemap);
        $this->addEventsInCityPages($sitemap);
        $this->addOrganizerPages($sitemap);

		return $sitemap->render('xml');
	}

    /**
     * Add all (visibile) 'events' pages.
     *
     * @param $sitemap
     */
    private function addEventPages($sitemap)
    {
        $events = $this->eventRepo->getAllEvents();

        foreach ($events as $event) {
            $sitemap->add(URL::to('jobmesse/' . $event->slug), $this->getIsoTimestamp($event), '0.9', 'weekly');
        }
    }

    /**
     * Add all 'events in region' pages
     *
     * @param $sitemap
     */
    private function addEventsInRegionPages($sitemap)
    {
        $regions = $this->regionRepo->getAll();

        foreach ($regions as $region) {
            $event = $this->eventRepo->getLastModifiedEventByRegion($region->id);

            $sitemap->add(URL::to('jobmessen/' . $region->slug), $this->getIsoTimestamp($event), '0.7', 'weekly');
        }
    }

    /**
     * Add all 'events in city' pages
     *
     * @param $sitemap
     */
    private function addEventsInCityPages($sitemap)
    {
        $cities = $this->cityRepo->getAll();

        foreach ($cities as $city) {
            $event = $this->eventRepo->getLastModifiedEventByCity($city->name);

            $sitemap->add(URL::to('jobmessen/in/' . $city->slug), $this->getIsoTimestamp($event), '0.7', 'weekly');
        }
    }

    /**
     * Add all 'organizer' pages
     *
     * @param $sitemap
     */
    private function addOrganizerPages($sitemap)
    {
        $organizers = $this->organizerRepo->getAll();

        foreach ($organizers as $organizer) {
            $event = $this->eventRepo->getLastModifiedEventByOrganizer($organizer->id);

            $sitemap->add(URL::to('veranstalter/' . $organizer->slug), $this->getIsoTimestamp($event), '0.7', 'weekly');
        }
    }

    /**
     * Get timestamp in ISO format
     *
     * @param $resource
     *
     * @return string
     */
    private function getIsoTimestamp($resource = null)
    {
        $timestamp = isset($resource->updated_at) ? $resource->updated_at : $this->default_timestamp;

        return date('c', strtotime($timestamp));
    }
}	
