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

    /**
     * Persist data.
     *
     * @param object $companyRepo
     * @param int $company_id
     *
     * @return static
     */
    public function persist($companyRepo, $company_id)
    {
        $company = $companyRepo->findById($company_id);

        $data = [
            'name'      => $this->request->get('name'),
            'full_name' => $this->request->get('full_name'),
            'featured'  => $this->request->get('featured', false),
            'premium'   => $this->request->get('premium', false)
        ];

        return $company->update($data);
    }

}
