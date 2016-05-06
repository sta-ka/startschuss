<?php namespace App\Http\Requests\Event;

use App\Http\Requests\Request;

class UploadLogoRequest extends Request {

 	protected $dontFlash = ['logo'];

	/**
	 * Get the validation rules that apply to the request.
	 *
	 * @return array
	 */
	public function rules()
	{
		return [
			'logo' => 'required|image|max:1000',
		];
	}

}
