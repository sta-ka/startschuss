<?php namespace App\Http\Requests\Organizer;

use App\Http\Requests\Request;

class UpdateContactsRequest extends Request {

	/**
	 * Get the validation rules that apply to the request.
	 *
	 * @return array
	 */
	public function rules()
	{
		return [
			'website'  => 'url',
			'facebook' => 'url',
			'twitter'  => 'url'
		];
	}

}
