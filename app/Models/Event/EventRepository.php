<?php namespace App\Models\Event;

interface EventRepository {

    /**
     * Create a new event
     *
     * @param array $data
     *
     * @return static
     */
    public function create(array $data);

    /**
     * Get all events including soft-deleted events (for admin area)
     *
     * @param bool $trashed
     *
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function getAll($trashed = false);

    /**
     * Get all events (for XML sitemap).
     * Only get latest event if multiple exist with same name
     * excluding soft-deleted events.
     *
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function getAllEvents();

    /**
     * Get all upcoming and visible events.
     *
     * @param int $limit
     *
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function getAllVisibleEvents($limit);

    /**
     * Get all events requested by user
     * if User-ID is given get only events requested by this user
     *
     * @param int|bool $user_id
     *
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function getRequestedEvents($user_id = false);

    /**
     * Get all upcoming and visible events  which offer interviews at their event
     * and are already linked to companies
     *
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function getEventsWithInterviews();

    /**
     * Get event by ID or fail
     *
     * @param int $event_id
     *
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function findById($event_id);

    /**
     * Get (latest) visible event by slug
     *
     * @param string $slug
     *
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function findBySlug($slug);

    /**
     * Get participating company for an event
     *
     * @param int $event_id
     * @param int $company_id
     *
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function findParticipant($event_id, $company_id);

    /**
     * Get events with pagination
     *
     * @param int $limit
     *
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function getPaginatedEvents($limit);

    /**
     * Get participating companies for an event
     *
     * @param int $event_id
     *
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function getParticipatingCompanies($event_id);

    /**
     * Get events by location/search term
     * Only return upcoming and visible events
     *
     * @param string $term
     *
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function getResults($term);

    /**
     * Get visible, upcoming events with the same name/slug
     *
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function getDuplicateEvents();

    /**
     * Get all applications for a given event
     *
     * @param int $event_id
     *
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function getApplications($event_id);

    /**
     * Get last modified event in database
     *
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function getLastModifiedEvent();

    /**
     * Get last modified event by organizer
     *
     * @param int $organizer_id
     *
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function getLastModifiedEventByOrganizer($organizer_id);

    /**
     * Get last modified event by region
     *
     * @param int $region_id
     *
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function getLastModifiedEventByRegion($region_id);

    /**
     * Get last modified event by city
     *
     * @param string $city
     *
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function getLastModifiedEventByCity($city);

    /**
     * Add company as participant for a given event
     *
     * @param int $event_id
     * @param int $company_id
     *
     * @return bool
     */
    public function addAsParticipant($event_id, $company_id);

    /**
     * Remove company as participant for a given event
     *
     * @param int $event_id
     * @param int $company_id
     *
     * @return bool
     */
    public function removeAsParticipant($event_id, $company_id);

    /**
     * Add interview tag
     *
     * @param int $event_id
     * @param int $company_id
     *
     * @return bool
     */
    public function addInterviewTag($event_id, $company_id);

    /**
     * Remove interview tag
     *
     * @param int $event_id
     * @param int $company_id
     *
     * @return bool
     */
    public function removeInterviewTag($event_id, $company_id);

    /**
     * Add comment
     *
     * @param int $event_id
     * @param int $company_id
     * @param string $comment
     *
     * @return bool
     */
    public function addComment($event_id, $company_id, $comment);

}