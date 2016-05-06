<?php namespace App\Http\Requests\Region;

use App\Http\Requests\Request;

class UpdateDataRequest extends Request {

	/**
	 * Get the validation rules that apply to the request.
	 *
	 * @return array
	 */
	public function rules()
	{
		return [
			'name' 				=> 'required',
			'slug' 				=> 'required',
			'description' 		=> 'required',
			'meta_description'	=> 'max:160',
			'keywords' 			=> 'max:160'
		];
	}

}
