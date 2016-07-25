<?php namespace App\Http\Requests\Company;

use App\Http\Requests\Request;

class UpdateContactsRequest extends Request {

	/**
	 * Get the validation rules that apply to the request.
	 *
	 * @return array
	 */
	public function rules()
	{
		return [
			'website'  => 'url',
			'facebook' => 'url',
			'twitter'  => 'url'
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
            'website'  => $this->request->get('website'),
            'facebook' => $this->request->get('facebook'),
            'twitter'  => $this->request->get('twitter')
        ];

        return $company->update($data);
    }

}
