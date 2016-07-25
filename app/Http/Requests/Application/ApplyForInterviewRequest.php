<?php namespace App\Http\Requests\Application;

use App\Http\Requests\Request;

class ApplyForInterviewRequest extends Request {

	/**
	 * Get the validation rules that apply to the request.
	 *
	 * @return array
	 */
	public function rules()
	{
		return [
			'cover_letter'	=> 'required|min:50',
			'comment'		=> ''
		];
	}

    /**
     * Persist data.
     *
     * @param object    $applicationRepo
     * @param int       $event_id
     * @param int       $company_id
     *
     * @return bool|int
     */
    public function persist($applicationRepo, $event_id, $company_id)
    {
        $data = [
            'applicant_id'	=> \Sentry::getUser()->getId(),
            'event_id'		=> $event_id,
            'company_id'	=> $company_id,
            'cover_letter'	=> $this->request->get('cover_letter'),
            'comment'		=> $this->request->get('comment')
        ];

        // creates a new application
        return $applicationRepo->submitApplication($data, $event_id, $company_id);
    }
}
