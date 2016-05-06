<?php namespace App\Http\Requests\Organizer;

use App\Http\Requests\Request;

class UpdateSeoDataRequest extends Request {

	/**
	 * Get the validation rules that apply to the request.
	 *
	 * @return array
	 */
	public function rules()
	{
		$organizer_id = $this->route()->parameter('organizer_id');

		return [
			'slug' 	   			=> 'required|alpha_dash|min:3|unique:organizers,slug,' . $organizer_id,
			'meta_description' 	=> 'max:160',
			'keywords' 			=> 'max:160'
		];
	}

}
