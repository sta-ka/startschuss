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

}
