<?php namespace App\Http\Requests\Event;

use App\Http\Requests\Request;

class UpdateApplicationDeadlineRequest extends Request {

	/**
	 * Get the validation rules that apply to the request.
	 *
	 * @return array
	 */
	public function rules()
	{
		return [
			'application_deadline'  => 'min:10|max:50'
		];
	}

}
