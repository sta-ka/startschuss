<?php namespace App\Models\Event;

use App\Models\Company\Company;
use DB;

class DbEventRepository implements EventRepository {

	/**
	 * Create a new event.
     *
     * @param array $data
     *
     * @return static
     */
	public function create(array $data)
	{
		return Events::create($data);
	}

	/**
	 * Get all events including soft-deleted events (for admin area).
     *
     * @param bool $trashed
     *
     * @return \Illuminate\Database\Eloquent\Collection
	 */
	public function getAll($trashed = false)
	{
		$query = Events::with(['revisionHistory', 'user']);

		if ($trashed) {
            $query->withTrashed();
        }

		return $query->get();
	}

	/**
	 * Get all events (for XML sitemap).
	 * Only get latest event if multiple exist with same name
	 * excluding soft-deleted events.
     *
     * @return \Illuminate\Database\Eloquent\Collection
	 */
	public function getAllEvents()
	{
		return DB::table('events')
					->from(DB::raw('(SELECT * FROM events ORDER BY start_date DESC) AS ordered_events'))
					->whereNull('deleted_at')
					->where('visible', 1)
					->groupBy('name')
					->get();
	}

	/**
	 * Get all upcoming and visible events.
     *
     * @param int $limit
     *
     * @return \Illuminate\Database\Eloquent\Collection
	 */
	public function getAllVisibleEvents($limit = 10)
	{
		return Events::with('organizer', 'region')
					->visible()
					->upcoming()
					->orderBy('start_date')
					->take($limit)
					->get();
	}

	/**
	 * Get all events requested by user
	 * if User-ID is given get only events requested by this user.
     *
     * @param int|bool $user_id
     *
     * @return \Illuminate\Database\Eloquent\Collection
	 */
	public function getRequestedEvents($user_id = false)
	{
		$query = Events::with('requestedBy');

		if ($user_id) {
            return $query->where('requested_by', $user_id)->get();
        }

        return $query->whereNotNull('requested_by')->get();
	}

	/**
	 * Get all upcoming and visible events  which offer interviews at their event
	 * and are already linked to companies.
     *
     * @return \Illuminate\Database\Eloquent\Collection
	 */
	public function getEventsWithInterviews()
	{
		return Events::where('interviews', 1)
					->where('applications_closed', 0)
					->visible()
					->upcoming()
					->whereHas('participants', function($query) {
						$query->where('interview', 1);
					})->get();
	}

	/**
	 * Get event by ID or fail.
     *
     * @param int $event_id
     *
     * @return \Illuminate\Database\Eloquent\Collection
	 */
	public function findById($event_id)
	{
		return Events::withTrashed()
					->where('id', $event_id)
					->firstOrFail();
	}

	/**
	 * Get (latest) visible event by slug.
     *
     * @param string $slug
     *
     * @return \Illuminate\Database\Eloquent\Collection
	 */
	public function findBySlug($slug)
	{
		return Events::with('organizer')
					->where('events.slug', $slug)
					->visible()
					->orderBy('start_date', 'desc')
					->firstOrFail();
	}

	/**
	 * Get participating company for an event.
     *
     * @param int $event_id
     * @param int $company_id
     *
     * @return \Illuminate\Database\Eloquent\Collection
	 */
	public function findParticipant($event_id, $company_id)
	{
		return Events::where('id', $event_id)
					->first()
					->participants()
					->where('company_id', $company_id)
					->first();
	}

	/**
	 * Get events with pagination
     *
     * @param int $limit
     *
     * @return \Illuminate\Database\Eloquent\Collection
	 */
	public function getPaginatedEvents($limit)
	{
		return Events::with('organizer', 'region')
					->upcoming()
					->visible()
					->orderBy('start_date')
                    ->paginate($limit);
	}

	/**
	 * Get participating companies for an event
     *
     * @param int $event_id
     *
     * @return \Illuminate\Database\Eloquent\Collection
	 */
	public function getParticipatingCompanies($event_id)
	{
		return Events::findOrFail($event_id)
					->participants;
	}

	/**
	 * Get events by location/search term
	 * Only return upcoming and visible events
     *
     * @param string $term
     *
     * @return \Illuminate\Database\Eloquent\Collection
	 */
	public function getResults($term)
	{
		return Events::with('organizer', 'region')
					->where('location', 'LIKE', "%$term%")
					->upcoming()
					->visible()
					->orderBy('start_date')
                    ->paginate(10);
	}

	/**
	 * Get visible, upcoming events with the same name/slug
     *
     * @return \Illuminate\Database\Eloquent\Collection
	 */
	public function getDuplicateEvents()
	{
		return Events::select('events.name', 'events.slug', DB::raw('COUNT(id) as count'))
					->upcoming()
					->visible()
					->groupBy('slug')
					->having('count', '>', 1)
					->get();
	}

	/**
	 * Get all applications for a given event
     *
     * @param int $event_id
     *
     * @return \Illuminate\Database\Eloquent\Collection
	 */
	public function getApplications($event_id)
	{
		return Events::findOrFail($event_id)
					->applications()
					->get();
	}

	/**
	 * Get last modified event in database
     *
     * @return \Illuminate\Database\Eloquent\Collection
	 */
	public function getLastModifiedEvent()
	{
		return Events::orderBy('updated_at', 'desc')
					->first();
	}

	/**
	 * Get last modified event by organizer
     *
     * @param int $organizer_id
     *
     * @return \Illuminate\Database\Eloquent\Collection
	 */
	public function getLastModifiedEventByOrganizer($organizer_id)
	{
		return Events::where('organizer_id', $organizer_id)
					->orderBy('updated_at', 'desc')
					->first();
	}

	/**
	 * Get last modified event by region
     *
     * @param int $region_id
     *
     * @return \Illuminate\Database\Eloquent\Collection
	 */	
	public function getLastModifiedEventByRegion($region_id)
	{
		return Events::where('region_id', $region_id)
					->orderBy('updated_at', 'desc')
					->first();
	}

	/**
	 * Get last modified event by city
     *
     * @param string $city
     *
     * @return \Illuminate\Database\Eloquent\Collection
	 */
	public function getLastModifiedEventByCity($city)
	{
		return Events::where('location', $city)
					->orderBy('updated_at', 'desc')
					->first();
	}

	/**
	 * Add company as participant for a given event
     *
     * @param int $event_id
     * @param int $company_id
     *
     * @return bool
	 */
	public function addAsParticipant($event_id, $company_id)
	{	
		$event = Events::findOrFail($event_id);
		$company = Company::findOrFail($company_id);

		// check, if company and event exists
		if ( ! $company or ! $event) {
            return false;
        }

		// check, if company is already a participant for this event
		if ($event->participants->contains($company_id)) {
            return false;
        }

		$event->participants()->attach($company_id);
		return true;
	}

	/**
	 * Remove company as participant for a given event
     *
     * @param int $event_id
     * @param int $company_id
     *
     * @return bool
	 */
	public function removeAsParticipant($event_id, $company_id)
	{
		$event = Events::findOrFail($event_id);

		return $event->participants()->detach($company_id);
	}

    /**
     * Add interview tag
     *
     * @param int $event_id
     * @param int $company_id
     *
     * @return bool
     */
    public function addInterviewTag($event_id, $company_id)
	{
		$event = Events::findOrFail($event_id);

		// check, if Company exists in participant table and does not already offer interviews
		if ($event->participants->contains($company_id)) {
			$company = $event->participants->find($company_id);

			if ($company->pivot->interview == 1) {
                return false;
            }

			return $company->pivot->update(['interview' => 1, 'updated_at' => new \DateTime]);
		}
		return false;
	}

    /**
     * Remove interview tag
     *
     * @param int $event_id
     * @param int $company_id
     *
     * @return bool
     */
    public function removeInterviewTag($event_id, $company_id)
	{
		$event = Events::findOrFail($event_id);

		// check, if Company exists in participant table and does already offer interviews
		if ($event->participants->contains($company_id)) {
			$company = $event->participants->find($company_id);

			if ($company->pivot->interview != 1) {
                return false;
            }

			return $company->pivot->update(['interview' => null, 'updated_at' => new \DateTime]);
		}
		return false;
	}

    /**
     * Add comment
     *
     * @param int $event_id
     * @param int $company_id
     * @param string $comment
     *
     * @return bool
     */
    public function addComment($event_id, $company_id, $comment)
	{
		$event = Events::findOrFail($event_id);

		// check, if Company exists in participant table
		if ($event->participants->contains($company_id)) {
			$company = $event->participants->find($company_id);

			if ($company->pivot->interview == 0) {
                return false;
            }

			return $company->pivot->update(['comment' => $comment, 'updated_at' => new \DateTime]);
		}
		return false;
	}

}