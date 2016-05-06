<?php namespace App\Models\Company\Job;

class DbJobRepository implements JobRepository {

	/**
	 * Create new job
     *
     * @param array $data
     *
     * @return static
	 */
	public function create(array $data)
	{
		return Job::create($data);
	}

	/**
	 * Get all jobs
     *
     * @param int|bool $limit
     *
     * @return \Illuminate\Database\Eloquent\Collection
	 */
	public function getAll($limit = false)
	{
		$query = Job::with('company')->withTrashed();

		if ($limit) {
            $query->limit($limit);
        }

		return $query->get();
	}

	/**
	 * Get all jobs
     *
     * @return \Illuminate\Database\Eloquent\Collection
	 */
	public function getActive()
	{
		return Job::with('company')
					->active()
					->approved()
					->paginate(12);
	}

	/**
	 * Get jobs by search
     *
     * @param string $term
     *
     * @return \Illuminate\Database\Eloquent\Collection
	 */
	public function getResults($term)
	{
		$query = Job::with('company');

		if (array_key_exists('stadt', $term)) {
            $query->where('location', 'LIKE', "%".$term['stadt']."%");
        }

		if (array_key_exists('typ', $term)) {
            $query->where('type', 'LIKE', "%".$term['typ']."%");
        }

		return $query->active()
					->approved()
					->paginate(12);
	}

	/**
	 * Get job by ID
     *
     * @param int $job_id
     * @param bool $trashed
     *
     * @return \Illuminate\Database\Eloquent\Collection
	 */
	public function findById($job_id, $trashed = true)
	{
		$query = Job::with('company');

		if ($trashed) {
            $query->withTrashed();
        }

		return $query->findOrFail($job_id);
	}

	/**
	 * Get job by slug
     *
     * @param string $slug
     *
     * @return \Illuminate\Database\Eloquent\Collection
	 */
	public function findBySlug($slug)
	{
		return Job::where('slug', $slug)
					->firstOrFail();
	}

}