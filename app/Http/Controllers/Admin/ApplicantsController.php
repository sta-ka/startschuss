<?php namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use App\Models\Applicant\ApplicantRepository as Applicants;

/**
 * Class ApplicantsController
 *
 * @package App\Http\Controllers\Admin
 */
class ApplicantsController extends Controller {

    /**
     * @var Applicants
     */
    private $applicantRepo;

	/**
	 * Constructor: inject dependencies.
     *
     * @param Applicants $applicantRepo
	 */
	public function __construct(Applicants $applicantRepo)
	{
		$this->applicantRepo = $applicantRepo;
	}

	/**
	 * Overview of all applicants.
     *
     * @return \Illuminate\View\View
	 */	
	public function index()
	{
		$data['applicants'] = $this->applicantRepo->getAll();

		return view('admin.applicants.overview', $data);
	}

	/**
	 * Show single applicant by ID.
     *
     * @param int $applicant_id
     *
     * @return \Illuminate\View\View
	 */
	public function show($applicant_id)
	{
		$data['applicant'] = $this->applicantRepo->findById($applicant_id);

		return view('admin.applicants.profile.show', $data);
	}

}