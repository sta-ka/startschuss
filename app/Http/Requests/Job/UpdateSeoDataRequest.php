<?php namespace App\Http\Requests\Job;

use App\Http\Requests\Request;

class UpdateSeoDataRequest extends Request {

	/**
	 * Get the validation rules that apply to the request.
	 *
	 * @return array
	 */
	public function rules()
	{
		return [
			'slug' 				=> 'required|alpha_dash|min:8',
			'meta_description'	=> 'max:160',
			'keywords' 			=> 'max:160'
		];
	}

}
