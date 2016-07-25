<?php namespace App\Http\Requests\Application;

use App\Http\Requests\Request;

class ArrangeInterviewRequest extends Request {

	/**
	 * Get the validation rules that apply to the request.
	 *
	 * @return array
	 */
	public function rules()
	{
		$rules = [
			'date'		=> 'required|date|date_format:"d.m.Y"',
			'hour'		=> 'required|numeric|min:8|max:20',
			'minute'	=> 'required|numeric|min:0|max:60'
		];

		$event_id = $this->route()->parameter('event_id');
		$eventRepo = \App::make('App\Models\Event\EventRepository');

		$event = $eventRepo->findById($event_id);

		// if date is not between start and end date
		if (! (strtotime($event->start_date) <= strtotime(\Input::get('date')) && strtotime(\Input::get('date')) <= strtotime($event->end_date) )){
			$rules['valid_date'] = 'required';
		}

		return $rules;
	}

    /**
     * Persist data.
     *
     * @param object    $applicationRepo
     * @param int       $application_id
     *
     * @return bool|int
     */
    public function persist($applicationRepo, $application_id)
    {
        $application = $applicationRepo->findById($application_id);

        $timestamp = \Date::germanToSql($this->request->get('date')) . ' ' . $this->request->get('hour') . ':' . $this->request->get('minute') . ':00';
        $data = ['time_of_interview' => $timestamp];

        // adds a time to the interview for the application
        return $application->update($data);
    }
}
