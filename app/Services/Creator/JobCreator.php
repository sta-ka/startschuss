<?php namespace App\Services\Creator;

use App\Models\Company\Job\JobRepository;

use Carbon\Carbon;

class JobCreator extends Creator {

	private $jobRepo;

    /**
     * @param JobRepository $jobRepo
     */
    public function __construct(JobRepository $jobRepo)
	{
		$this->jobRepo = $jobRepo;
	}

    /**
     * Perform create.
     *
     * @param array $input
     * @param int   $company_id
     *
     * @return static
     */
    public function createJob($input, $company_id)
	{
		$data = [
			'title'				=> $input['title'],
			'slug'				=> \Str::slug($input['title']),
			'company_id'		=> $company_id,
			'location'			=> $input['location'],
			'start_date'		=> $input['start_date'],
			'description'		=> \Purifier::clean($input['description']),
			'requirements'		=> \Purifier::clean($input['requirements']),
			'created_by'		=> \Sentry::getUser()->username,
			'published_at'		=> Carbon::now(),
			'expire_at'			=> Carbon::now()->addDays(30),
			'meta_description'	=> \Str::limit($input['description'], 150)
		];

		return $this->jobRepo->create($data);
	}

    /**
     * Perform update.
     *
     * @param array $input
     * @param int   $job_id
     *
     * @return bool|int
     */
    public function editData($input, $job_id)
	{
		$job = $this->jobRepo->findById($job_id);

		$data = [
			'title'				=> $input['title'],
			'location'			=> $input['location'],
			'start_date'		=> $input['start_date'],
			'description'		=> \Purifier::clean($input['description']),
			'requirements'		=> \Purifier::clean($input['requirements']),
		];

		return $job->update($data);
	}

    /**
     * Perform update.
     *
     * @param array $input
     * @param int   $job_id
     *
     * @return bool|int
     */
    public function editSeoData($input, $job_id)
	{
		$job = $this->jobRepo->findById($job_id);

		$data = [
			'slug'				=> $input['slug'],
			'meta_description'	=> $input['meta_description'],
			'keywords'			=> $input['keywords']
		];

		return $job->update($data);
	}

    /**
     * Perform update.
     *
     * @param int   $job_id
     *
     * @return bool|int
     */
    public function editSettings($job_id)
	{
		$job = $this->jobRepo->findById($job_id);

		$data = [
			'featured'	=> \Input::get('featured', false),
			'premium'	=> \Input::get('premium', false)
		];

		return $job->update($data);
	}
}