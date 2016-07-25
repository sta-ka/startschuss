<?php namespace App\Http\Requests\Event;

use Carbon\Carbon;
use App\Http\Requests\Request;

class CommitEventRequest extends Request {

	/**
	 * Get the validation rules that apply to the request.
	 *
	 * @return array
	 */
	public function rules()
	{
		return [
			'contact'		=> 'required|min:3',
			'email'			=> 'required|email|min:3',
			'name'			=> 'required|min:3',
			'location'		=> 'required|min:3',
			'start_date'	=> 'required|date|date_format:"d.m.Y"|after:' . Carbon::now()->format('d.m.Y'),
			'end_date'		=> 'sometimes|date|date_format:"d.m.Y"|after:' . Carbon::parse(\Input::get('start_date'))->subHour(6),
			'region'		=> 'required|exists:regions,name',
			'organizer'		=> 'required'
		];
	}
}
