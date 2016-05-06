<?php namespace App\Http\Requests\Applicant;

use App\Http\Requests\Request;


class UpdateBasicsRequest extends Request {

	/**
	 * Get the validation rules that apply to the request.
	 *
	 * @return array
	 */
	public function rules()
	{
		return [
			'name'		=> 'required|min:5',
			'birthday'	=> 'date|date_format:"d.m.Y"'
		];
	}

}
