<?php namespace App\Http\Requests\Organizer;

use App\Http\Requests\Request;

class CreateOrganizerRequest extends Request {

	/**
	 * Get the validation rules that apply to the request.
	 *
	 * @return array
	 */
	public function rules()
	{
		return [
			'name'	=> 'required|min:3|unique:organizers,name',
			'slug' 	=> 'required|alpha_dash|min:3|unique:organizers,slug'
		];
	}

}
