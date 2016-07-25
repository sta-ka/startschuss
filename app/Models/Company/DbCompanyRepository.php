<?php namespace App\Models\Company;

class DbCompanyRepository implements CompanyRepository {

	/**
	 * Create new company
     *
     * @param array $data
     *
     * @return static
     */
    public function create(array $data)
	{
		return Company::create($data);
	}

	/**
	 * Get all companies
	 * if trashed = true => include soft-deleted companies
     *
     * @param bool $trashed
     *
     * @return \Illuminate\Database\Eloquent\Model
	 */
	public function getAll($trashed = false)
	{
		$query = Company::with(['revisionHistory' ,'users']);

		if ($trashed) {
            $query->withTrashed();
        }

		return $query->get();
	}

	/**
	 * Get company by ID or fail include soft-deleted companies
     *
     * @param int $company_id
     *
     * @return \Illuminate\Database\Eloquent\Model
	 */
	public function findById($company_id)
	{
		return Company::withTrashed()
					->where('id', $company_id)
					->firstOrFail();
	}

	/**
	 * Get company by slug or fail
	 * do not include soft-deleted companies
     *
     * @param string $slug
     *
     * @return \Illuminate\Database\Eloquent\Model
	 */
	public function findBySlug($slug)
	{
		return Company::where('slug', $slug)
					->firstOrFail();
	}

	/**
	 * Get all companies 
	 * and include info whether they participate in a given event or not
     *
     * @param int $event_id
     *
     * @return \Illuminate\Database\Eloquent\Model
	 */
	public function getCompanies($event_id)
	{
		return Company::with(['participants' => function($query) use($event_id) {
						$query->where('event_id', $event_id);
					}])->get();
	}

	/**
	 * Get participating companies hosting interviews for an event
     *
     * @param int $user_id
     * @param int $event_id
     *
     * @return \Illuminate\Database\Eloquent\Model
	 */
	public function getCompaniesGivingInterviews($user_id, $event_id)
	{
		return Company::with(['applications' => function($query) use ($user_id) {
						$query->where('applicant_id', $user_id);
					}])
					->whereHas('participants', function($query) use ($event_id) {
						$query->where('interview', 1);
						$query->where('event_id', $event_id);
					})
					->get();
	}

	/**
	 * Get all users which are linked to the given company
     *
     * @param int $company_id
     *
     * @return \Illuminate\Database\Eloquent\Model
	 */
	public function getUsers($company_id)
	{
		return Company::withTrashed()
					->findOrFail($company_id)
					->users;
	}

	/**
	 * Link a company to a user
     *
     * @param int $company_id
     * @param int $user_id
     *
     * @return \Illuminate\Database\Eloquent\Model
	 */
	public function addLinkage($company_id, $user_id)
	{
		$company = Company::findOrFail($company_id);
			
		if ($company->users->contains($user_id)) { // company is already linked to a user
            return false;
        }

		$company->users()->attach($user_id);

		return true;
	}

	/**
	 * Delete linkage between company and user
     *
     * @param int $company_id
     * @param int $user_id
     *
     * @return \Illuminate\Database\Eloquent\Model
	 */
	public function deleteLinkage($company_id, $user_id)
	{
		$company = Company::findOrFail($company_id);
			
		if ( ! $company->users->contains($user_id)) { // company is not linked to any user
            return false;
        }

		$company->users()->detach($user_id);

		return true;
	}


}