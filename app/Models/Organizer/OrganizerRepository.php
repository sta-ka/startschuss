<?php namespace App\Models\Organizer;

interface OrganizerRepository {

    /**
     * Get all organizers.
     *
     * @param bool $trashed
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getAll($trashed = false);

    /**
     * Create new organizer.
     *
     * @param array $data
     *
     * @return static
     */
    public function create(array $data);

    /**
     * Get organizer by ID.
     *
     * @param int $organizer_id
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function findById($organizer_id);

    /**
     * Get organizer by slug.
     *
     * @param string $slug
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function findBySlug($slug);

    /**
     * Get an array of all organizers with the specified columns and keys.
     *
     * @param string $column
     * @param string $key
     *
     * @return array
     */
    public function lists($column, $key);

    /**
     * Get all organizers with pagination.
     *
     * @param int $limit
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getPaginatedOrganizers($limit);

    /**
     * Randomly get 4 featured organizers.
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getFeaturedOrganizers();

    /**
     * Get organizers by first letter.
     *
     * @param string $str
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getByLetter($str);

    /**
     * Get events for a specific organizer.
     *
     * @param int $organizer_id
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getEventsForOrganizer($organizer_id);

    /**
     * Get last modified organizer in database.
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getLastModifiedOrganizer();

}