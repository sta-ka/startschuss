<?php namespace App\Services\Creator;

use App\Models\Applicant\Application\ApplicationRepository;

class ApplicationCreator extends Creator {

	private $applicationRepo;

    /**
     * @param ApplicationRepository $applicationRepo
     */
    public function __construct(ApplicationRepository $applicationRepo)
	{
		$this->applicationRepo = $applicationRepo;
	}

    /**
     * Perform update.
     *
     * @param array $input
     * @param int   $event_id
     * @param int   $company_id
     *
     * @return static
     */
    public function submitApplication($input, $event_id, $company_id)
	{
        $data = [
			'applicant_id'	=> \Sentry::getUser()->getId(),
			'event_id'		=> $event_id,
			'company_id'	=> $company_id,
			'cover_letter'	=> $input['cover_letter'],
			'comment'		=> $input['comment']
			];

		// creates a new application
		return $this->applicationRepo->submitApplication($data, $event_id, $company_id);
	}

    /**
     * Perform update.
     *
     * @param array $input
     * @param int   $application_id
     *
     * @return bool|int
     */
    public function arrangeInterview($input, $application_id)
	{
		$application = $this->applicationRepo->findById($application_id);

        $timestamp = \Date::germanToSql($input['date']) . ' ' . $input['hour'] . ':' . $input['minute'] . ':00';
        $data = ['time_of_interview' => $timestamp];

		// adds a time to the interview for the application
		return $application->update($data);
	}

}
