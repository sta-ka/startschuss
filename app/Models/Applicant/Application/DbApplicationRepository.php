<?php namespace App\Models\Applicant\Application;

use App\Models\Event\Events;

class DbApplicationRepository implements ApplicationRepository {

	/**
	 * Get all applications 
	 * if user is given -> get all applications by this user.
     *
     * @param int|bool $user_id
     *
     * @return \Illuminate\Database\Eloquent\Collection
	 */
	public function getAll($user_id = false)
	{
		$query = Application::with('company', 'event')
					->withTrashed();

		if ($user_id) {
            $query->where('applicant_id', $user_id);
        }

		return $query->get();
	}

	/**
	 * Get application by ID.
     *
     * @param int $application_id
     *
     * @return \Illuminate\Database\Eloquent\Collection
	 */
	public function findById($application_id)
	{
		return Application::with('user' ,'company', 'event')
					->findOrFail($application_id);
	}

	/**
	 * Get application by ID and User ID.
     *
     * @param int $user_id
     * @param int $application_id
     *
     * @return \Illuminate\Database\Eloquent\Model|static
	 */
	public function getSingle($user_id, $application_id)
	{
		return Application::with('user' ,'company', 'event')
					->where('id', $application_id)
					->where('applicant_id', $user_id)
					->firstOrFail();
	}

	/**
	 * Submit new application.
     *
     * @param array $data
     * @param int $event_id
     * @param int $company_id
     *
     * @return static
	 */
	public function submitApplication($data, $event_id, $company_id)
	{
		// check if company exists and offers interviews
		$count = Events::findOrFail($event_id)
					->participants()
					->wherePivot('interview', 1)
					->wherePivot('company_id', $company_id)
					->count();

		if ($count != 1) {
            return false;
        }

		return Application::create($data);
	}

	/**
	 * Approve application as organizer.
     *
     * @param int $application_id
     *
     * @return bool|int
	 */
	public function approveApplication($application_id)
	{
		$application = $this->findById($application_id);

		// check if application is already processed by organizer
		if ($application->approved_by_organizer || $application->rejected_by_organizer) {
            return false;
        }

		return $application->update(['approved_by_organizer' => 1]);
	}

	/**
	 * Disapprove application as organizer.
     *
     * @param int $application_id
     *
     * @return bool|int
	 */
	public function disapproveApplication($application_id)
	{
		$application = $this->findById($application_id);

		// check if application is already processed by organizer
		if ($application->approved_by_organizer || $application->rejected_by_organizer) {
            return $application->update(['rejected_by_organizer' => 1]);
        }

		return false;
	}

	/**
	 * Accept application as company.
     *
     * @param int $application_id
     *
     * @return bool|int
	 */
	public function acceptApplication($application_id)
	{
		$application = $this->findById($application_id);

		// check if application is already processed by organizer
		if ($application->approved_by_organizer || $application->rejected_by_organizer) {
            return $application->update(['accepted_by_company' => 1]);
        }

		return false;
	}

	/**
	 * Reject application as company.
     *
     * @param int $application_id
     *
     * @return bool|int
	 */
	public function rejectApplication($application_id)
	{
		$application = $this->findById($application_id);

		// check if application is already processed by organizer
		if ($application->approved_by_organizer || $application->rejected_by_organizer) {
            return $application->update(['rejected_by_company' => 1]);
        }

		return false;
	}

}