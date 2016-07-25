<?php namespace App\Models\Applicant\Experience;

use App\Models\Applicant\Applicant;

class DbExperienceRepository implements ExperienceRepository {

	/**
	 * Create new experience.
     *
     * @param array $data
     *
     * @return static
	 */
	public function create(array $data)
	{
		return Experience::create($data);
	}

	/**
	 * Get experience by ID.
     *
     * @param int $experience_id
     *
     * @return \Illuminate\Database\Eloquent\Model
	 */
	public function findById($experience_id)
	{
		$user = \Sentry::getUser();
		$applicant = Applicant::where('user_id', $user->getId())->firstOrFail();

		return Experience::where('applicant_id', $applicant->id)
						->where('id', $experience_id)
						->firstOrFail();
	}
	
	/**
	 * Get all experience by user ID.
     *
     * @param int $applicant_id
     *
     * @return \Illuminate\Database\Eloquent\Model
	 */
	public function findAllById($applicant_id)
	{
		return Experience::where('applicant_id', $applicant_id)
					->orderBy('end_date', 'desc')
					->get();
	}

}
		