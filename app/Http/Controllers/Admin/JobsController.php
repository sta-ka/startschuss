<?php namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Company\Job\JobRepository as Jobs;
use App\Services\Creator\JobCreator;

use App\Http\Requests\Job\UpdateDataRequest;
use App\Http\Requests\Job\UpdateSeoDataRequest;
use App\Http\Requests\Job\UpdateSettingsRequest;

/**
 * Class JobsController
 *
 * @package App\Http\Controllers\Admin
 */
class JobsController extends Controller {

    /**
     * @var Jobs
     */
    private $jobRepo;

	/**
	 * Constructor: inject dependencies.
     *
     * @param Jobs $jobRepo
	 */
	public function __construct(Jobs $jobRepo)
	{
		$this->jobRepo = $jobRepo;
	}

	/**
	 * Overview of all jobs.
     *
     * @return \Illuminate\View\View
	 */	
	public function index()
	{
		$data['jobs'] = $this->jobRepo->getAll();

		return view('admin.jobs.show', $data);
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
		$data['job'] = $this->jobRepo->findById($job_id);

		return view('admin.jobs.profile.show', $data);
	}

	/**
	 * Approve new job.
     *
     * @param int $job_id
     *
     * @return \Illuminate\Http\RedirectResponse
	 */
	public function approveJob($job_id)
	{
		$job = $this->jobRepo->findById($job_id);

		$job->update(['approved' => 1]);

		return redirect('admin/jobs/'.$job_id.'/show');
	}

	/**
	 * Cancel approval to a job.
     *
     * @param int $job_id
     *
     * @return \Illuminate\Http\RedirectResponse
	 */
	public function cancelApproval($job_id)
	{
		$job = $this->jobRepo->findById($job_id);
		
		$job->update(['approved' => 0]);

		return redirect('admin/jobs/'.$job_id.'/show');
	}

	/**
	 * Change active/inactive status.
     *
     * @param int $job_id
     *
     * @return \Illuminate\Http\RedirectResponse
	 */
	public function changeStatus($job_id)
	{
		$job = $this->jobRepo->findById($job_id);

		$status = $job->active; // get status of job and change it
		$job->update(['active' => ! $status]);

		return redirect('admin/jobs/'.$job_id.'/show');
	}	

	/**
	 * Display 'Edit job data' form.
     *
     * @param int $job_id
     *
     * @return \Illuminate\View\View
	 */
	public function editData($job_id)
	{
		$data['job'] = $this->jobRepo->findById($job_id);

		return view('admin.jobs.profile.edit_data', $data);
	}

	/**
	 * Process editing.
     *
     * @param UpdateDataRequest $request
     * @param int $job_id
     *
     * @return \Illuminate\Http\RedirectResponse
	 */
	public function updateData(UpdateDataRequest $request, $job_id)
	{
		(new JobCreator($this->jobRepo))
			->editData($request->all(), $job_id);

		return redirect('admin/jobs/'.$job_id.'/show');
	}

	/**
	 * Display 'Edit SEO data' form.
     *
     * @param int $job_id
     *
     * @return \Illuminate\View\View
	 */
	public function editSeoData($job_id)
	{
		$data['job'] = $this->jobRepo->findById($job_id);

		return view('admin.jobs.profile.edit_seo_data', $data);
	}

	/**
	 * Process editing of SEO data.
     *
     * @param UpdateSeoDataRequest $request
     * @param int $job_id
     *
     * @return \Illuminate\Http\RedirectResponse
	 */
	public function updateSeoData(UpdateSeoDataRequest $request, $job_id)
	{
		(new JobCreator($this->jobRepo))
			->editSeoData($request->all(), $job_id);

		return redirect('admin/jobs/'.$job_id.'/show');
	}

	/**
	 * Display 'Settings' page.
     *
     * @param int $job_id
     *
     * @return \Illuminate\View\View
	 */
	public function editSettings($job_id)
	{
		$data['job'] = $this->jobRepo->findById($job_id);

		return view('admin.jobs.profile.settings', $data);
	}

	/**
	 * Process editing settings.
     *
     * @param UpdateSettingsRequest $request
     * @param int $job_id
     *
     * @return \Illuminate\Http\RedirectResponse
	 */
	public function updateSettings(UpdateSettingsRequest $request, $job_id)
	{
		(new JobCreator($this->jobRepo))
			->editSettings($job_id);

		return redirect('admin/jobs/'.$job_id.'/show');
	}


	/**
	 * Delete job - Soft delete is enabled.
     *
     * @param int $job_id
     *
     * @return \Illuminate\Http\RedirectResponse
	 */
	public function delete($job_id)
	{
		$job = $this->jobRepo->findById($job_id);

		// check if job is soft deleted
		if ( ! $job->deleted_at) {
			$success = $job->delete(); // soft-delete job
			notify($success, 'job_delete');

            return redirect('admin/jobs');
        }

        $job->forceDelete();

		notify('success', 'job_delete');
        return redirect('admin/jobs');
	}

	/**
	 * Restore soft deleted job.
     *
     * @param int $job_id
     *
     * @return \Illuminate\Http\RedirectResponse
	 */
	public function restore($job_id)
	{
		$job = $this->jobRepo->findById($job_id);

        if ($job->deleted_at) {
            $job->restore();
        }

        return redirect('admin/jobs/'.$job_id.'/show');
	}	
}