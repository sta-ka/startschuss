<?php namespace App\Http\Requests\Organizer;

use App\Http\Requests\Request;

class UpdateProfileRequest extends Request {

	/**
	 * Get the validation rules that apply to the request.
	 *
	 * @return array
	 */
	public function rules()
	{
		return [
			'profile' 		=> 'min:30'
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
            'address1'	=> $this->request->get('address1'),
            'address2'	=> $this->request->get('address2'),
            'address3'	=> $this->request->get('address3'),
            'profile'	=> \Purifier::clean($this->request->get('profile'))
        ];

        return $organizer->update($data);
    }
}
