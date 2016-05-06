<?php namespace App\Http\Requests\User;

use App\Http\Requests\Request;

class SendMailRequest extends Request {

	/**
	 * Get the validation rules that apply to the request.
	 *
	 * @return array
	 */
	public function rules()
	{
		return [
			'subject'   => 'required|min:10',
			'body'	    => 'required|min:12'
		];
	}

}
