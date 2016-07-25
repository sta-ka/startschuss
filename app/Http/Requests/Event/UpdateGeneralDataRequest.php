<?php namespace App\Http\Requests\Event;

use App\Http\Requests\Request;

use Carbon\Carbon;

class UpdateGeneralDataRequest extends Request {

	/**
	 * Get the validation rules that apply to the request.
	 *
	 * @return array
	 */
	public function rules()
	{
		return [
			'name'       => 'required|min:3',
			'location'   => 'required|min:3',
			'start_date' => 'required|date|date_format:"d.m.Y"', // after rule omitted (editing old events)
			'end_date'	 => 'sometimes|date|date_format:"d.m.Y"|after:' . Carbon::parse(\Input::get('start_date'))->subHour(6),
			'interviews' => 'in:0,1'
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
            'name'			=> $this->request->get('name'),
            'location'		=> $this->request->get('location'),
            'start_date'	=> $this->request->get('start_date'),
            'end_date'		=> empty($this->request->get('end_date')) ? $this->request->get('start_date') : $this->request->get('end_date'),
            'interviews'	=> \Input::get('interviews', false),
            'region_id'		=> $this->request->get('region_id'),
            'organizer_id'	=> $this->request->get('organizer_id')
        ];

        return $event->update($data);
    }

}
