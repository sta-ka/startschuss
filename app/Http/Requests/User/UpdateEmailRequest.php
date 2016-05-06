<?php namespace App\Http\Requests\User;

use App\Http\Requests\Request;

class UpdateEmailRequest extends Request {

	/**
	 * Get the validation rules that apply to the request.
	 *
	 * @return array
	 */
	public function rules()
	{
		$user_id = $this->route()->parameter('user_id');
		
		return [
			'email' 	=> 'required|email|unique:users,email,'. $user_id,
			'password'  => 'required'
		];
	}

}
