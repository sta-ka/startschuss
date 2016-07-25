<?php namespace App\Http\Requests\Event;

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
			'opening_hours1' 	 => 'max:30',
			'opening_hours2' 	 => 'max:30',
			'admission'		 	 => 'max:30',
			'specific_location1' => 'max:25',
			'specific_location2' => 'max:25',
			'specific_location3' => 'max:25',
		];
	}

    /**
     * Persist data.
     *
     * @param object    $eventRepo
     * @param int       $event_id
     *
     * @return bool|int
     */
    public function persist($eventRepo, $event_id)
    {
        $event = $eventRepo->findById($event_id);

        $data = [
            'opening_hours1'		=> $this->request->get('opening_hours1'),
            'opening_hours2'		=> $this->request->get('opening_hours2'),
            'admission'				=> $this->request->get('admission'),
            'specific_location1'	=> $this->request->get('specific_location1'),
            'specific_location2'	=> $this->request->get('specific_location2'),
            'specific_location3'	=> $this->request->get('specific_location3'),
            'profile'				=> \Purifier::clean($this->request->get('profile'))
        ];

        if (\Input::has('audiences')) {
            $data['audience'] = implode(', ', $this->request->get('audiences') ? $this->request->get('audiences') : []);
        }

        return $event->update($data);
    }
}
