<?php namespace App\Http\Requests\User;

use App\Http\Requests\Request;

class LoginRequest extends Request {

	/**
	 * Get the validation rules that apply to the request.
	 *
	 * @return array
	 */
	public function rules()
	{
		return [
			'username'	=> 'required',
			'password' 	=> 'required'
		];
	}

}
