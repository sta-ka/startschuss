<?php namespace App\Http\Requests\Organizer;

use App\Http\Requests\Request;

class UpdateGeneralDataRequest extends Request {

	/**
	 * Get the validation rules that apply to the request.
	 *
	 * @return array
	 */
	public function rules()
	{
		$organizer_id = $this->route()->parameter('organizer_id');
		
		return [
			'name' 		=> 'required|min:3|unique:organizers,name,' . $organizer_id,
			'featured'	=> 'in:1,0',
			'premium'	=> 'in:1,0'
		];
	}

}
