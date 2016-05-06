<?php namespace App\Http\Controllers\Company;

use App\Models\Company\Job\JobRepository as Jobs;
use App\Models\User\UserRepository as Users;
use App\Http\Controllers\Controller;
use App\Http\Requests\Job\CreateJobRequest;
use App\Services\Creator\JobCreator;

/**
 * Class JobsController
 *
 * @package App\Http\Controllers\Company
 */
class JobsController extends Controller
{

    /**
     * @var Jobs
     */
    private $jobRepo;

    /**
     * @var Users
     */
    private $userRepo;

    /**
     * @var \Cartalyst\Sentry\Users\UserInterface
     */
    private $user;

    /**
     * Constructor: inject dependencies and apply filters.
     *
     * @param Jobs  $jobRepo
     * @param Users $userRepo
     */
    public function __construct(Jobs $jobRepo, Users $userRepo)
    {
        $this->jobRepo = $jobRepo;
        $this->userRepo = $userRepo;

        $this->user = \Sentry::getUser();

        // check if user is linked to a company
        $this->middleware('check.company');

        // check if a company belongs to the currently logged-in user
        $this->middleware('ownership.company', ['only' => 'create']);

        // check if a job belongs to the currently logged-in company user
        $this->middleware('ownership.job', ['only' => 'show']);
    }

    /**
     * Jobs overview.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $data['jobs'] = $this->userRepo->getJobs($this->user->getId());

        return view('company.jobs.overview', $data);
    }

    /**
     * Show single job by ID.
     *
     * @param int $job_id
     *
     * @return \Illuminate\View\View
     */
    public function show($job_id)
    {
        $data['job'] = $this->userRepo->getJob($this->user->getId(), $job_id);

        return view('company.jobs.show', $data);
    }

    /**
     * Display 'New job' form.
     *
     * @return \Illuminate\View\View
     */
    public function newJob()
    {
        $data['company'] = $this->userRepo->getCompany($this->user->getId());

        return view('company.jobs.new', $data);
    }

    /**
     * Create new job.
     *
     * @param CreateJobRequest $request
     * @param int              $company_id
     * @param Jobs             $jobRepo
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function create(CreateJobRequest $request, $company_id, Jobs $jobRepo)
    {
        $success = (new JobCreator($jobRepo))
                        ->createJob($request->all(), $company_id);

        notify($success, 'job_created');

        return redirect('company/jobs');
    }
}