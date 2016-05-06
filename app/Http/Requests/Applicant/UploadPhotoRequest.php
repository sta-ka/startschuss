<?php namespace App\Http\Requests\Applicant;

use App\Http\Requests\Request;

class UploadPhotoRequest extends Request {

    /**
     * The input keys that should not be flashed on redirect.
     *
     * @var array
     */
    protected $dontFlash = ['photo'];
	
	/**
	 * Get the validation rules that apply to the request.
	 *
	 * @return array
	 */
	public function rules()
	{
		return [
			'photo' => 'required|image|max:1000'
		];
	}

}
