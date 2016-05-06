<?php namespace App\Http\Requests\User;

use App\Http\Requests\Request;

class UpdateUserRequest extends Request {

	/**
	 * Get the validation rules that apply to the request.
	 *
	 * @return array
	 */
	public function rules()
	{
		$user_id = $this->route()->parameter('id');

		return [
			'username' => 'required|min:3|alpha_dot|unique:users,username,'. $user_id,
			'email'    => 'required|email|unique:users,email,'. $user_id
		];
	}

}
