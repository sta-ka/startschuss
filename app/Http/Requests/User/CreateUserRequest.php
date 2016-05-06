<?php namespace App\Http\Requests\User;

use App\Http\Requests\Request;

class CreateUserRequest extends Request {

	/**
	 * Get the validation rules that apply to the request.
	 *
	 * @return array
	 */
	public function rules()
	{
		return [
			'username'	=> 'required|min:3|alpha_dot|unique:users,username',
			'email'		=> 'required|email|unique:users,email',
			'group'  	=> 'required|in:2,3,4'
		];
	}

}
