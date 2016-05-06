<?php namespace App\Http\Controllers\Frontend;

use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Routing\Controller;

use App\Models\Misc\Article\ArticleRepository as Articles;
use App\Models\Misc\City\CityRepository as Cities;
use App\Models\Company\CompanyRepository as Companies;
use App\Models\Company\Job\JobRepository as Jobs;

use Input;

/**
 * Class CareerController
 *
 * @package App\Http\Controllers\Frontend
 */
class CareerController extends Controller {

    /**
     * @var Jobs
     */
    private $jobRepo;

    /**
     * Constructor: inject dependencies.
     *
     * @param Jobs      $jobRepo
     */
    public function __construct(Jobs $jobRepo)
	{
		$this->jobRepo = $jobRepo;
	}

	/**
	 * Displays all jobs, highlight premium jobs.
     *
     * @return \Illuminate\View\View
	 */
	public function jobs()
	{
		if (Input::has('stadt') || Input::has('typ')) {
			$data['jobs'] = $this->jobRepo->getResults(Input::all());
		} else {
			$data['jobs'] = $this->jobRepo->getActive();
		}

		return view('start.jobs', $data);
	}


    /**
     * 'Jobs in city' page - Display jobs based on given city.
     *
     * @param string $slug
     * @param Cities $cityRepo
     *
     * @return \Illuminate\View\View
     */
    public function jobsIn($slug, Cities $cityRepo)
	{
        try {
            $data['city'] = $cityRepo->findBySlug($slug);
            $data['jobs'] = $this->jobRepo->getResults([
                                            'stadt' => $slug,
                                            'typ'   => Input::get('typ')
            ]);

            return view('start.jobs_by_city', $data);
        } catch (ModelNotFoundException $e) {
            notify('error', 'city_not_found', false);
            return redirect()->route('messekalender');
        }
	}

	/**
	 * Displays a single job.
     *
     * @param int $job_id
     *
     * @return \Illuminate\View\View
	 */
	public function job($job_id)
	{
        try {
            $data['job'] = $this->jobRepo->findById($job_id, false); // false = do not include soft-deleted jobs

            return view('start.job', $data);
        } catch (ModelNotFoundException $e) {
            notify('error', 'job_not_found', false);
            return redirect('jobs');
        }
	}

	/**
	 * Displays a single company.
     *
     * @param string $slug
     * @param Companies $companyRepo
     *
     * @return \Illuminate\View\View
	 */
	public function unternehmen($slug, Companies $companyRepo)
	{
        try {
            $data['company'] = $companyRepo->findBySlug($slug);

            return view('start.company', $data);
        } catch (ModelNotFoundException $e) {
            notify('error', 'company_not_found', false);
            return redirect('jobs');
        }
	}

	/**
	 * Displays all articles, highlight featured articles.
     *
     * @param Articles $articleRepo
     *
     * @return \Illuminate\View\View
	 */
	public function ratgeber(Articles $articleRepo)
	{
		$data['featured_articles'] = $articleRepo->getFeatured(2);
		$data['articles'] 		   = $articleRepo->getOthers(); // get other articles excluding the two featured articles
		
		return view('start.guide', $data);
	}

	/**
	 * Show single article.
     *
     * @param string $slug
     * @param Articles $articleRepo
     *
     * @return \Illuminate\View\View
	 */
	public function artikel($slug, Articles $articleRepo)
	{
        try {
            $data['article']  = $articleRepo->findBySlug($slug);
            $data['articles'] = $articleRepo->getOthers($slug);

            return view('start.article', $data);
        } catch (ModelNotFoundException $e) {
            notify('error', 'article_not_found', false);
            return redirect('karriereratgeber');
        }
	}
}