<?php namespace App\Http\Requests\Job;

use App\Http\Requests\Request;

class UpdateSeoDataRequest extends Request {

	/**
	 * Get the validation rules that apply to the request.
	 *
	 * @return array
	 */
	public function rules()
	{
		return [
			'slug' 				=> 'required|alpha_dash|min:8',
			'meta_description'	=> 'max:160',
			'keywords' 			=> 'max:160'
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
            'slug'				=> $this->request->get('slug'),
            'meta_description'	=> $this->request->get('meta_description'),
            'keywords'			=> $this->request->get('keywords')
        ];

        return $job->update($data);
    }
}
