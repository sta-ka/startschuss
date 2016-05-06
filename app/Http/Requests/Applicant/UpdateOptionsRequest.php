<?php namespace App\Http\Requests\Applicant;

use App\Http\Requests\Request;


class UpdateOptionsRequest extends Request {

	/**
	 * Get the validation rules that apply to the request.
	 *
	 * @return array
	 */
	public function rules()
	{
        if (\Input::get('region_id') == 0) {
            $rules = [
                'region_id'		=> 'required'
            ];
        } else {
            $rules = [
                'region_id'		=> 'required|exists:regions,id'
            ];
        }

        return $rules;
	}

}
