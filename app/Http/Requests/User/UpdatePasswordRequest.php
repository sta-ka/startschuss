<?php namespace App\Http\Requests\User;

use App\Http\Requests\Request;

class UpdatePasswordRequest extends Request {

	/**
	 * Get the validation rules that apply to the request.
	 *
	 * @return array
	 */
	public function rules()
	{
		return [
			'oldpassword' => 'required',
			'newpassword' => 'required|min:7|max:20|same:passwordconfirmation'
		];
	}

}
