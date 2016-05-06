<?php namespace App\Http\Requests\Organizer;

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
			'profile' 		=> 'min:30'
		];
	}

}
