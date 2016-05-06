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

}
