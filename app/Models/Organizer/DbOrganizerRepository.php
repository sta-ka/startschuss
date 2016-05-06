<?php namespace App\Models\Organizer;

class DbOrganizerRepository implements OrganizerRepository {

	/**
	 * Create new organizer.
     *
     * @param array $data
     *
     * @return static
	 */
	public function create(array $data)
	{
		return Organizer::create($data);
	}

	/**
	 * Get all organizers.
     *
     * @param bool $trashed
     *
     * @return \Illuminate\Database\Eloquent\Collection
	 */
	public function getAll($trashed = false)
	{
		$query = Organizer::with(['revisionHistory']);

        if ($trashed) {
            $query->withTrashed();
        }

		return $query->get();
	}

	/**
	 * Get organizer by ID.
     *
     * @param int $organizer_id
     *
     * @return \Illuminate\Database\Eloquent\Collection
	 */
	public function findById($organizer_id)
	{
		return Organizer::withTrashed()
					->findOrFail($organizer_id);
	}

	/**
	 * Get organizer by slug.
     *
     * @param string $slug
     *
     * @return \Illuminate\Database\Eloquent\Collection
	 */	
	public function findBySlug($slug)
	{
		return Organizer::where('slug', $slug)
						->firstOrFail();
	}

	/**
	 * Get an array of all organizers with the specified columns and keys.
     *
     * @param string $column
     * @param string $key
     *
     * @return array
	 */
	public function lists($column, $key)
	{
		return Organizer::lists($column, $key);
	}

	/**
	 * Get all organizers with pagination.
     *
     * @param int $limit
     *
     * @return \Illuminate\Database\Eloquent\Collection
	 */
	public function getPaginatedOrganizers($limit)
	{
		return Organizer::orderBy('name')
						->paginate($limit);
	}

	/**
	 * Randomly get 4 featured organizers.
     *
     * @return \Illuminate\Database\Eloquent\Collection
	 */
	public function getFeaturedOrganizers()
	{
		return Organizer::take(4)
						->where('featured', 1)
						->orderByRaw('RAND()')
						->get();
	}

	/**
	 * Get organizers by first letter.
     *
     * @param string $str
     *
     * @return \Illuminate\Database\Eloquent\Collection
	 */
	public function getByLetter($str)
	{
		return Organizer::where('name', 'LIKE', $str."%")
						->orderBy('name')
						->paginate(10);
	}	

	/**
	 * Get events for a specific organizer.
     *
     * @param int $organizer_id
     *
     * @return \Illuminate\Database\Eloquent\Collection
	 */
	public function getEventsForOrganizer($organizer_id)
	{
		return Organizer::findOrFail($organizer_id)
						->events()
                        ->with('region')
						->visible()
						->upcoming()
						->orderBy('start_date')
						->take(12)
						->get();
	}

	/**
	 * Get last modified organizer in database.
     *
     * @return \Illuminate\Database\Eloquent\Collection
	 */
	public function getLastModifiedOrganizer()
	{
		return Organizer::orderBy('updated_at', 'desc')
						->first();
	}

}