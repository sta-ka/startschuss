<?php namespace App\Models\Company\Job;

interface JobRepository {

    /**
     * Create new job
     *
     * @param array $data
     *
     * @return static
     */
    public function create(array $data);

    /**
     * Get all jobs
     *
     * @param int|bool $limit
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getAll($limit = false);

    /**
     * Get all jobs
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getActive();

    /**
     * Get jobs by search
     *
     * @param string $term
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getResults($term);

    /**
     * Get job by ID
     *
     * @param int $job_id
     * @param bool $trashed
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function findById($job_id, $trashed = true);

    /**
     * Get job by slug
     *
     * @param string $slug
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function findBySlug($slug);

}