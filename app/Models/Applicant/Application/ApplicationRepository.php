<?php namespace App\Models\Applicant\Application;

interface ApplicationRepository {

    /**
     * Get all applications
     * if user is given -> get all applications by this user.
     *
     * @param int|bool $user_id
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getAll($user_id = false);

    /**
     * Get application by ID.
     *
     * @param int $application_id
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function findById($application_id);

    /**
     * Get application by ID and User ID.
     *
     * @param int $user_id
     * @param int $application_id
     *
     * @return \Illuminate\Database\Eloquent\Model|static
     */
    public function getSingle($user_id, $application_id);

    /**
     * Submit new application.
     *
     * @param array $data
     * @param int $event_id
     * @param int $company_id
     *
     * @return static
     */
    public function submitApplication($data, $event_id, $company_id);

    /**
     * Approve application as organizer.
     *
     * @param int $application_id
     *
     * @return bool|int
     */
    public function approveApplication($application_id);

    /**
     * Disapprove application as organizer.
     *
     * @param int $application_id
     *
     * @return bool|int
     */
    public function disapproveApplication($application_id);

    /**
     * Accept application as company.
     *
     * @param int $application_id
     *
     * @return bool|int
     */
    public function acceptApplication($application_id);

    /**
     * Reject application as company.
     *
     * @param int $application_id
     *
     * @return bool|int
     */
    public function rejectApplication($application_id);

}
