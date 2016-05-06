<?php namespace App\Services\Creator;

use App\Models\Applicant\ApplicantRepository;
use App\Models\Applicant\Experience\ExperienceRepository;

class ExperienceCreator extends Creator {

	private $applicantRepo;

	private $experienceRepo;

    /**
     * @param ApplicantRepository  $applicantRepo
     * @param ExperienceRepository $experienceRepo
     */
    public function __construct(ApplicantRepository $applicantRepo, ExperienceRepository $experienceRepo)
	{
		$this->applicantRepo = $applicantRepo;

		$this->experienceRepo = $experienceRepo;
	}

    /**
     * Perform create.
     *
     * @param array $input
     *
     * @return static
     */
    public function addExperience($input)
	{
        $applicant = $this->applicantRepo->findByUserId(\Sentry::getUser()->getId());

		$data = [
			'applicant_id'		=> $applicant->id,
			'company'			=> $input['company'],
			'industry'			=> $input['industry'],
			'job_description'	=> $input['job_description'],
			'to_date'			=> \Input::get('to_date') ? $input['to_date'] : 0,
			'month_start'		=> $input['month_start'],
			'year_start'		=> $input['year_start'],
			'month_end'			=> \Input::get('to_date') ? 0 : $input['month_end'],
			'year_end'			=> \Input::get('to_date') ? 0 : $input['year_end'],
			'start_date'		=> \Date::germanToSql('01.' . $input['month_start'] .'.'. $input['year_start']),
			'end_date'			=> \Input::get('to_date') ? '2030-01-01' : \Date::germanToSql('01.'. $input['month_end'] .'.'. $input['year_end'])
			];
		
		return $this->experienceRepo->create($data);
	}

    /**
     * Perform update.
     *
     * @param array $input
     * @param int   $experience_id
     *
     * @return bool|int
     */
    public function editExperience($input, $experience_id)
	{
		$experience = $this->experienceRepo->findById($experience_id);

		$data = [
			'company'			=> $input['company'],
			'industry'			=> $input['industry'],
			'job_description'	=> $input['job_description'],
			'to_date'			=> \Input::get('to_date') ? $input['to_date'] : 0,
			'month_start'		=> $input['month_start'],
			'year_start'		=> $input['year_start'],
			'month_end'			=> \Input::get('to_date') ? 0 : $input['month_end'],
			'year_end'			=> \Input::get('to_date') ? 0 : $input['year_end'],
			'start_date'		=> \Date::germanToSql('01.' . $input['month_start'] .'.'. $input['year_start']),
			'end_date'			=> \Input::get('to_date') ? '2030-01-01' : \Date::germanToSql('01.'. $input['month_end'] .'.'. $input['year_end'])
			];

		return $experience->update($data);
	}

}
