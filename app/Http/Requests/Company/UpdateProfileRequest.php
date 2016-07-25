<?php namespace App\Http\Requests\Company;

use App\Http\Requests\Request;

class UpdateProfileRequest extends Request {

	/**
	 * Get the validation rules that apply to the request.
	 *
	 * @return array
	 */
	public function rules()
	{
		return [
			'profile' 	 => 'min:30'
		];
	}

    /**
     * Persist data.
     *
     * @param object $companyRepo
     * @param int    $company_id
     *
     * @return static
     */
    public function persist($companyRepo, $company_id)
    {
        $company = $companyRepo->findById($company_id);

        $data = [
            'profile' => \Purifier::clean($this->request->get('profile'))
        ];

        return $company->update($data);
    }

}
