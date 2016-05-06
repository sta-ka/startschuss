<?php namespace App\Http\Requests\Job;

use App\Http\Requests\Request;

class UpdateDataRequest extends Request {

	/**
	 * Get the validation rules that apply to the request.
	 *
	 * @return array
	 */
	public function rules()
	{
		return [
			'title' 		=> 'required|max:80',
			'location' 		=> 'required|max:20',
			'start_date' 	=> 'required|max:20',
			'description' 	=> 'required',
			'requirements' 	=> 'required'
		];
	}

}
