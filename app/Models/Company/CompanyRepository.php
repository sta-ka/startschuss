<?php namespace App\Models\Company;

interface CompanyRepository {

    /**
     * Create new company
     *
     * @param array $data
     *
     * @return static
     */
    public function create(array $data);


    /**
     * Get all companies
     * if trashed = true => include soft-deleted companies
     *
     * @param bool $trashed
     *
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function getAll($trashed = false);

    /**
     * Get company by ID or fail include soft-deleted companies
     *
     * @param int $company_id
     *
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function findById($company_id);

    /**
     * Get company by slug or fail
     * do not include soft-deleted companies
     *
     * @param string $slug
     *
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function findBySlug($slug);

    /**
     * Get all companies
     * and include info whether they participate in a given event or not
     *
     * @param int $event_id
     *
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function getCompanies($event_id);

    /**
     * Get participating companies hosting interviews for an event
     *
     * @param int $user_id
     * @param int $event_id
     *
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function getCompaniesGivingInterviews($user_id, $event_id);

    /**
     * Get all users which are linked to the given company
     *
     * @param int $company_id
     *
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function getUsers($company_id);

    /**
     * Link a company to a user
     *
     * @param int $company_id
     * @param int $user_id
     *
     * @return \Illuminate\Database\Eloquent\Model
     */
	public function addLinkage($company_id, $user_id);

    /**
     * Delete linkage between company and user
     *
     * @param int $company_id
     * @param int $user_id
     *
     * @return \Illuminate\Database\Eloquent\Model
     */
	public function deleteLinkage($company_id, $user_id);

}