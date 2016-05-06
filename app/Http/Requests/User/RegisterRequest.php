<?php namespace App\Http\Requests\User;

use App\Http\Requests\Request;

class RegisterRequest extends Request {

	/**
	 * Get the validation rules that apply to the request.
	 *
	 * @return array
	 */
	public function rules()
	{
		return [
			'username'				=> 'required|min:3|alpha_dot|unique:users,username',
			'email'					=> 'required|email|unique:users,email',
			'password'				=> 'required|same:password_confirmation|min:7|max:20',
			'password_confirmation' => 'required|min:7|max:20'
		];
	}

}
