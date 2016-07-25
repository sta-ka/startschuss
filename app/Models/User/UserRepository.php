<?php namespace App\Models\User;

interface UserRepository {

    /**
     * Get all user with info about their revisionHistory, user group
     * and their throttle status
     *
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function getAll();

    /**
     * Get an array of all users in a certain group with the specified columns and keys
     *
     * @param string $column
     * @param string $key
     * @param null|int $group_id
     *
     * @return array
     */
    public function lists($column, $key, $group_id = null);

    /**
     * Get single user by ID
     * with info about their throttle status
     *
     * @param int $id
     *
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function findById($id);

    /**
     * Get the company linked to the given user
     *
     * @param int $id
     *
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function getCompany($id);

    /**
     * Get the jobs linked to the given user
     *
     * @param int $user_id
     *
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function getJobs($user_id);

    /**
     * Get job by ID
     * checking if job belongs to given user
     *
     * @param int $user_id
     * @param int $job_id
     *
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function getJob($user_id, $job_id);

    /**
     * Get all events for a single user
     * upcoming determines if it is an upcoming or past event
     *
     * @param int $user_id
     * @param bool $upcoming
     *
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function getEvents($user_id, $upcoming = true);

    /**
     * Get all upcoming events which hosts interviews for a single user (company or organizer)
     *
     * @param int $user_id
     * @param string $user_group
     *
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function getEventsHostingInterviews($user_id, $user_group);

    /**
     * Get applications for company
     *
     * @param int $user_id
     * @param int $event_id
     *
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function getApplicationsForCompany($user_id, $event_id);

    /**
     * Get all logins for a single user
     *
     * @param int $user_id
     *
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function getLogins($user_id);

    /**
     * Get all login attempts
     *
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function getLoginAttempts();

    /**
     * Check if an event belongs to the given user
     * include all events or only upcoming events
     *
     * @param int $event_id
     * @param int $user_id
     * @param bool $all
     *
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function checkEventOwnership($event_id, $user_id, $all);

    /**
     * Check if a company belongs to the given user
     *
     * @param int $company_id
     * @param int $user_id
     *
     * @return int
     */
    public function checkCompanyOwnership($company_id, $user_id);

    /**
     * Check if a job belongs to the given user
     *
     * @param int $job_id
     * @param int $user_id
     *
     * @return int
     */
    public function checkJobOwnership($job_id, $user_id);

    /**
     * Check if user is linked to a company
     *
     * @param int $user_id
     *
     * @return int
     */
    public function checkForCompany($user_id);

    /**
     * Check if user already applied for the company at the given event
     *
     * @param int $user_id
     * @param int $event_id
     * @param int $company_id
     *
     * @return int
     */
    public function checkForApplication($user_id, $event_id, $company_id);

    /**
     * Check if application belongs to given organizer/company user
     *
     * @param int $user_id
     * @param int $application_id
     * @param int $event_id
     * @param string $user_group
     *
     * @return int
     */
    public function checkApplicationOwnership($event_id, $application_id, $user_id, $user_group);

}