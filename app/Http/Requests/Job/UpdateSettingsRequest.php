<?php namespace App\Http\Requests\Job;

use App\Http\Requests\Request;

class UpdateSettingsRequest extends Request {

	/**
	 * Get the validation rules that apply to the request.
	 *
	 * @return array
	 */
	public function rules()
	{
		return [
			'featured'	=> 'in:1,0',
			'premium'	=> 'in:1,0'
		];
	}

}
