<?php namespace App\Models\User;

class DbUserRepository implements UserRepository {

	/**
	 * Get all user with additional info.
     *
     * @return \Illuminate\Database\Eloquent\Model
	 */
	public function getAll()
	{
		return User::with(['revisionHistory', 'group', 'throttle'])
					->withTrashed()
					->get();
	}

	/**
	 * Get an array of all users in a certain group with the specified columns and keys.
     *
     * @param string $column
     * @param string $key
     * @param null|int $group_id
     *
     * @return array
	 */
	public function lists($column, $key, $group_id = null)
	{
		if ($group_id == 3) { // 3 = group_id for company
			return User::whereHas('group', function($query) use ($group_id) {
							$query->where('id', $group_id);
						})
						->has('company', '<', 1)
						->lists($column, $key);
		} elseif ($group_id) {
			return User::whereHas('group', function($query) use ($group_id)
					{
						$query->where('id', $group_id);
					})
					->lists($column, $key);
		} else {
			return User::lists($column, $key);
		}
	}

	/**
	 * Get single user by ID with info about their throttle status.
     *
     * @param int $id
     *
     * @return \Illuminate\Database\Eloquent\Model
	 */
	public function findById($id)
	{
		return User::with('throttle')
					->withTrashed()
					->findOrFail($id);
	}

	/**
	 * Get the company linked to the given user.
     *
     * @param int $id
     *
     * @return \Illuminate\Database\Eloquent\Model
	 */
	public function getCompany($id)
	{
		return User::withTrashed()
					->findOrFail($id)
					->company()
					->first();
	}

	/**
	 * Get the jobs linked to the given user.
     *
     * @param int $user_id
     *
     * @return \Illuminate\Database\Eloquent\Model
	 */
	public function getJobs($user_id)
	{
		return User::withTrashed()
					->findOrFail($user_id)
					->company()
					->first()
					->jobs()
					->get();
	}

	/**
	 * Get job by ID (if job belongs to given user).
     *
     * @param int $user_id
     * @param int $job_id
     *
     * @return \Illuminate\Database\Eloquent\Model
	 */
	public function getJob($user_id, $job_id)
	{
		return User::findOrFail($user_id)
					->company()
					->firstOrFail()
					->jobs()
					->where('id', $job_id)
					->firstOrFail();
	}

	/**
	 * Get all events for a single user
	 * upcoming determines if it is an upcoming or past event.
     *
     * @param int $user_id
     * @param bool $upcoming
     *
     * @return \Illuminate\Database\Eloquent\Model
	 */
	public function getEvents($user_id, $upcoming = true)
	{
		return User::withTrashed()
					->findOrFail($user_id)
					->events()
					->upcoming($upcoming)
					->orderBy('end_date')
					->get();
	}

	/**
	 * Get all upcoming events which hosts interviews for a single user (company or organizer).
     *
     * @param int $user_id
     * @param string $user_group
     *
     * @return \Illuminate\Database\Eloquent\Model
	 */
	public function getEventsHostingInterviews($user_id, $user_group)
	{
		if ($user_group == 'organizer') {
			return User::findOrFail($user_id)
						->events()
						->where('interviews', 1)
						->upcoming()
						->get();
		} elseif ($user_group == 'company') {
			return User::findOrFail($user_id)
						->company()
						->firstOrFail()
						->events()
						->where('interviews', 1)
						->upcoming()
						->get();
		}
	}

	/**
	 * Get applications for company.
     *
     * @param int $user_id
     * @param int $event_id
     *
     * @return \Illuminate\Database\Eloquent\Model
	 */
	public function getApplicationsForCompany($user_id, $event_id)
	{
		return User::findOrFail($user_id)
						->company()
						->first()
						->applications()
						->where('event_id', $event_id)
						->get();
	}

	/**
	 * Get all logins for a single user.
     *
     * @param int $user_id
     *
     * @return \Illuminate\Database\Eloquent\Model
	 */
	public function getLogins($user_id)
	{
		return User::withTrashed()
					->where('id', $user_id)
					->first()
					->logins()
					->orderBy('created_at', 'desc')
					->get();
	}

	/**
	 * Get all login attempts.
     *
     * @return \Illuminate\Database\Eloquent\Model
	 */
	public function getLoginAttempts()
	{
		return User::with('throttle')
					->withTrashed()
					->has('throttle')
					->get();
	}

	/**
	 * Check if an event belongs to the given user
	 * include all events or only upcoming events.
     *
     * @param int $event_id
     * @param int $user_id
     * @param bool $all
     *
     * @return \Illuminate\Database\Eloquent\Model
	 */
	public function checkEventOwnership($event_id, $user_id, $all)
	{
		$query = User::findOrFail($user_id)
					->events();

		if (! $all) {
            $query->upcoming(); // include upcoming events
        }

		return $query->where('id', $event_id)
					->count();
	}

	/**
	 * Check if a company belongs to the given user.
     *
     * @param int $company_id
     * @param int $user_id
     *
     * @return int
	 */
	public function checkCompanyOwnership($company_id, $user_id)
	{
		return User::findOrFail($user_id)
					->company()
					->where('id', $company_id)
					->count();
	}

	/**
	 * Check if a job belongs to the given user.
     *
     * @param int $job_id
     * @param int $user_id
     *
     * @return int
	 */
	public function checkJobOwnership($job_id, $user_id)
	{
		return User::findOrFail($user_id)
					->company()
					->first()
					->jobs()
					->where('id', $job_id)
					->count();
	}

	/**
	 * Check if user is linked to a company.
     *
     * @param int $user_id
     *
     * @return int
	 */
	public function checkForCompany($user_id)
	{
		return User::findOrFail($user_id)
					->company()
					->count();
	}
	
	/**
	 * Check if user already applied for the company at the given event.
     *
     * @param int $user_id
     * @param int $event_id
     * @param int $company_id
     *
     * @return int
	 */
	public function checkForApplication($user_id, $event_id, $company_id)
	{
		return User::find($user_id)
					->applications()
					->where('event_id', $event_id)
					->where('company_id', $company_id)
					->count();
	}	

	/**
	 * Check if application belongs to given organizer/company user.
     *
     * @param int $user_id
     * @param int $application_id
     * @param int $event_id
     * @param string $user_group
     *
     * @return int
	 */
	public function checkApplicationOwnership($event_id, $application_id, $user_id, $user_group)
	{
		if ($user_group == 'organizer') {
			return User::findOrFail($user_id)
						->events()
						->findOrFail($event_id)
						->applications()
						->where('id', $application_id)
						->count();
		} elseif ($user_group == 'company') {
			return User::findOrFail($user_id)
						->company()
						->firstOrFail()
						->applications()
						->where('event_id', $event_id)
						->where('id', $application_id)
						->count();			
		}

	}
}