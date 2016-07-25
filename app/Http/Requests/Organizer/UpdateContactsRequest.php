<?php namespace App\Http\Requests\Organizer;

use App\Http\Requests\Request;

class UpdateContactsRequest extends Request {

	/**
	 * Get the validation rules that apply to the request.
	 *
	 * @return array
	 */
	public function rules()
	{
		return [
			'website'  => 'url',
			'facebook' => 'url',
			'twitter'  => 'url'
		];
	}

    /**
     * Persist data.
     *
     * @param object   $organizerRepo
     * @param int      $organizer_id
     *
     * @return bool|int
     */
    public function persist($organizerRepo, $organizer_id)
    {
        $organizer = $organizerRepo->findById($organizer_id);

        $data = [
            'website' 	=> $this->request->get('website'),
            'facebook' 	=> $this->request->get('facebook'),
            'twitter' 	=> $this->request->get('twitter')
        ];

        return $organizer->update($data);
    }
}
