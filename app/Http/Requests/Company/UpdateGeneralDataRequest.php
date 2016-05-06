<?php namespace App\Http\Requests\Company;

use App\Http\Requests\Request;

class UpdateGeneralDataRequest extends Request {

	/**
	 * Get the validation rules that apply to the request.
	 *
	 * @return array
	 */
	public function rules()
	{
		$company_id = $this->route()->parameter('company_id');
		
		return [
			'name'		=> 'required|min:3|unique:companies,name,' . $company_id,
			'full_name'	=> 'required|min:3|unique:companies,full_name,' . $company_id,
			'featured'	=> 'in:1,0',
			'premium'	=> 'in:1,0'
		];
	}

}
