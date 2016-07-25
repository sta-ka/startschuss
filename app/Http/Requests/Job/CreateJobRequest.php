<?php namespace App\Http\Requests\Job;

use App\Http\Requests\Request;
use Carbon\Carbon;

class CreateJobRequest extends Request {

	/**
	 * Get the validation rules that apply to the request.
	 *
	 * @return array
	 */
	public function rules()
	{
		return [
			'title' 		=> 'required|max:80',
            'location' 		=> 'required|max:20',
            'start_date' 	=> 'required|max:20',
			'description' 	=> 'required',
			'requirements' 	=> 'required'
		];
	}

    /**
     * Persist data.
     *
     * @param object   $jobRepo
     * @param int      $company_id
     *
     * @return bool|int
     */
    public function persist($jobRepo, $company_id)
    {
        $data = [
            'title'				=> $this->request->get('title'),
            'slug'				=> \Str::slug($this->request->get('title')),
            'company_id'		=> $company_id,
            'location'			=> $this->request->get('location'),
            'start_date'		=> $this->request->get('start_date'),
            'description'		=> \Purifier::clean($this->request->get('description')),
            'requirements'		=> \Purifier::clean($this->request->get('requirements')),
            'created_by'		=> \Sentry::getUser()->username,
            'published_at'		=> Carbon::now(),
            'expire_at'			=> Carbon::now()->addDays(30),
            'meta_description'	=> \Str::limit($this->request->get('description'), 150)
        ];

        return $jobRepo->create($data);
    }

}
