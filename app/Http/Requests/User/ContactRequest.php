<?php namespace App\Http\Requests\User;

use App\Http\Requests\Request;

class ContactRequest extends Request {

	/**
	 * Get the validation rules that apply to the request.
	 *
	 * @return array
	 */
	public function rules()
	{
		return [
			'name' 	=> 'required|min:3',
			'email'	=> 'required|email',
			'body'	=> 'required|min:12'
		];
	}

}
