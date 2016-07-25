<?php namespace App\Http\Requests\Job;

use App\Http\Requests\Request;

class UpdateDataRequest extends Request {

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
     * @param int      $job_id
     *
     * @return bool|int
     */
    public function persist($jobRepo, $job_id)
    {
        $job = $jobRepo->findById($job_id);

        $data = [
            'title'				=> $this->request->get('title'),
            'location'			=> $this->request->get('location'),
            'start_date'		=> $this->request->get('start_date'),
            'description'		=> \Purifier::clean($this->request->get('description')),
            'requirements'		=> \Purifier::clean($this->request->get('requirements')),
        ];

        return $job->update($data);
    }
}
