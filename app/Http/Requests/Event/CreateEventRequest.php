<?php namespace App\Http\Requests\Event;

use App\Http\Requests\Request;

use Carbon\Carbon;

class CreateEventRequest extends Request {

	/**
	 * Get the validation rules that apply to the request.
	 *
	 * @return array
	 */
	public function rules()
	{
		return [
			'name'			=> 'required|min:3',
			'slug'			=> 'required|min:3|alpha_dash',
			'location'		=> 'required|min:3',
			'start_date'	=> 'required|date|date_format:"d.m.Y"|after:' . Carbon::now()->format('d.m.Y'),
			'end_date'		=> 'sometimes|date|date_format:"d.m.Y"|after:' . Carbon::parse(\Input::get('start_date'))->subHour(6),
			'organizer_id'	=> 'required'
		];
	}

    /**
     * Persist data.
     *
     * @param object    $eventRepo
     *
     * @return bool|int
     */
    public function persist($eventRepo)
    {
        $data = [
            'name'			=> $this->request->get('name'),
            'location'		=> $this->request->get('location'),
            'start_date'	=> $this->request->get('start_date'),
            'end_date'		=> empty($this->request->get('end_date')) ? $this->request->get('start_date') : $this->request->get('end_date'),
            'profile'		=> \Purifier::clean($this->request->get('profile')),
            'slug'			=> $this->request->get('slug'),
            'region_id'		=> $this->request->get('region_id'),
            'organizer_id'	=> $this->request->get('organizer_id')
        ];

        return $eventRepo->create($data);
    }
}
