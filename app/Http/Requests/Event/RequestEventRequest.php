<?php namespace App\Http\Requests\Event;

use App\Http\Requests\Request;

use Carbon\Carbon;

class RequestEventRequest extends Request {

	/**
	 * Get the validation rules that apply to the request.
	 *
	 * @return array
	 */
	public function rules()
	{
		return [
			'name'			=> 'required|min:3',
			'location'		=> 'required|min:3',
			'start_date'	=> 'required|date|date_format:"d.m.Y"|after:' . Carbon::now()->format('d.m.Y'),
			'end_date'		=> 'sometimes|date|date_format:"d.m.Y"|after:start_date', 
			'region_id'		=> 'required|exists:regions,id'
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
        $organizer = $eventRepo->findById($event_id)->organizer;

        $data = [
            'name'               => $this->request->get('name'),
            'location'           => $this->request->get('location'),
            'start_date'         => $this->request->get('start_date'),
            'end_date'           => empty($this->request->get('end_date')) ? $this->request->get('start_date') : $this->request->get('end_date'),
            'specific_location1' => $this->request->get('specific_location1'),
            'specific_location2' => $this->request->get('specific_location2'),
            'specific_location3' => $this->request->get('specific_location3'),
            'profile'            => \Purifier::clean($this->request->get('profile')),
            'slug'               => \Str::slug($this->request->get('name')),
            'visible'            => 0,
            'region_id'          => $this->request->get('region_id'),
            'organizer_id'       => $organizer->id,
            'requested_by'       => \Sentry::getUser()->getId()
        ];

        // creates a new, unactivated event in the event table
        return $eventRepo->create($data);
    }
}
