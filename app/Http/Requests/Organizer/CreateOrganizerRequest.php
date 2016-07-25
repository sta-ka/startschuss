<?php namespace App\Http\Requests\Organizer;

use App\Http\Requests\Request;

class CreateOrganizerRequest extends Request {

	/**
	 * Get the validation rules that apply to the request.
	 *
	 * @return array
	 */
	public function rules()
	{
		return [
			'name'	=> 'required|min:3|unique:organizers,name',
			'slug' 	=> 'required|alpha_dash|min:3|unique:organizers,slug'
		];
	}

    /**
     * Persist data.
     *
     * @param object    $organizerRepo
     *
     * @return bool|int
     */
    public function persist($organizerRepo)
    {
        $data = [
            'name'		=> $this->request->get('name'),
            'slug'		=> $this->request->get('slug')
        ];

        return $organizerRepo->create($data);
    }


}
