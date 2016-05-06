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

}
