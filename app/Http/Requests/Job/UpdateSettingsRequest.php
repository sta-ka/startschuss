<?php namespace App\Http\Requests\Job;

use App\Http\Requests\Request;

class UpdateSettingsRequest extends Request {

	/**
	 * Get the validation rules that apply to the request.
	 *
	 * @return array
	 */
	public function rules()
	{
		return [
			'featured'	=> 'in:1,0',
			'premium'	=> 'in:1,0'
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
            'featured'	=> $this->request->get('featured', false),
            'premium'	=> $this->request->get('premium', false)
        ];

        return $job->update($data);
    }
}
