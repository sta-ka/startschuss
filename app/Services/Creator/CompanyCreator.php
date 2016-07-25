<?php namespace App\Services\Creator;

use App\Models\Company\CompanyRepository;

class CompanyCreator extends Creator {

	private $companyRepo;

    /**
     * @param CompanyRepository $companyRepo
     */
    public function __construct(CompanyRepository $companyRepo)
	{
		$this->companyRepo = $companyRepo;
	}

    /**
     * Perform create.
     *
     * @param array $input
     *
     * @return static
     */
    public function create($input)
	{
		$data = [
			'name'		=> $input['name'],
			'full_name' => $input['full_name']
		];

		return $this->companyRepo->create($data);
	}

    /**
     * Perform update.
     *
     * @param array $input
     * @param int   $company_id
     *
     * @return bool|int
     */
    public function editGeneralData($input, $company_id)
	{
        $company = $this->companyRepo->findById($company_id);

		$data = [
			'name' 		=> $input['name'], 
			'full_name' => $input['full_name'],
			'featured'	=> \Input::get('featured', false),
			'premium'	=> \Input::get('premium', false)
		];

		return $company->update($data);
	}

    /**
     * Perform update.
     *
     * @param array $input
     * @param int   $company_id
     *
     * @return bool|int
     */
    public function editProfile($input, $company_id)
	{
        $company = $this->companyRepo->findById($company_id);

		$data = [
			'profile'	=> \Purifier::clean($input['profile'])
		];

		return $company->update($data);
	}

    /**
     * Perform update.
     *
     * @param array $input
     * @param int   $company_id
     *
     * @return bool|int
     */
    public function editContacts($input, $company_id)
	{
        $company = $this->companyRepo->findById($company_id);

		$data = [
			'website' 	=> $input['website'], 
			'facebook' 	=> $input['facebook'], 
			'twitter' 	=> $input['twitter']
		];

		return $company->update($data);
	}

    /**
     * Perform update.
     *
     * @param int $company_id
     *
     * @return bool|int
     */
    public function processLogo($company_id)
	{
        $company = $this->companyRepo->findById($company_id);

        $filename = $this->createFilename($company);

		// resize image	and save it
		$this->uploadImage(\Input::file('logo'), 100, 50, 'uploads/logos/medium/' . $filename);
		\Input::file('logo')->move('uploads/logos/original/', $filename);

		return $company->update(['logo' => $filename]);
	}

}