<?php namespace App\Http\Requests\Company;

use App\Http\Requests\Request;

class CreateCompanyRequest extends Request {

	/**
	 * Get the validation rules that apply to the request.
	 *
	 * @return array
	 */
	public function rules()
	{
		return [
			'name'      => 'required|min:3|unique:companies,name',
			'full_name' => 'required|min:3|unique:companies,full_name'
		];
	}

    /**
     * Persist data.
     *
     * @param object $companyRepo
     *
     * @return static
     */
    public function persist($companyRepo)
    {
        $data = [
            'name'		=> $this->request->get('name'),
            'full_name' => $this->request->get('full_name')
        ];

        return $companyRepo->create($data);
    }

}
