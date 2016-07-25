<?php namespace App\Http\Requests\Organizer;

use App\Http\Requests\Request;

class UpdateGeneralDataRequest extends Request {

	/**
	 * Get the validation rules that apply to the request.
	 *
	 * @return array
	 */
	public function rules()
	{
		$organizer_id = $this->route()->parameter('organizer_id');
		
		return [
			'name' 		=> 'required|min:3|unique:organizers,name,' . $organizer_id,
			'featured'	=> 'in:1,0',
			'premium'	=> 'in:1,0'
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
            'name'		=> $this->request->get('name'),
            'featured'	=> $this->request->get('featured', false),
            'premium'	=> $this->request->get('premium', false)
        ];

        return $organizer->update($data);
    }
}
