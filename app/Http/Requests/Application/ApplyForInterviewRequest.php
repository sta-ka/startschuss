<?php namespace App\Http\Requests\Application;

use App\Http\Requests\Request;

class ApplyForInterviewRequest extends Request {

	/**
	 * Get the validation rules that apply to the request.
	 *
	 * @return array
	 */
	public function rules()
	{
		return [
			'cover_letter'	=> 'required|min:50',
			'comment'		=> ''
		];
	}

}
