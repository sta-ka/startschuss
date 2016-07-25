<?php namespace App\Http\Controllers\Company;

use App\Http\Controllers\Controller;

use App\Models\User\UserRepository as Users;
use App\Models\Company\CompanyRepository as Companies;

use App\Http\Requests\Company\UploadLogoRequest;
use App\Http\Requests\Company\UpdateProfileRequest;
use App\Http\Requests\Company\UpdateContactsRequest;

use Sentry;

/**
 * Class ProfileController
 *
 * @package App\Http\Controllers\Company
 */
class ProfileController extends Controller {

    /**
     * @var Companies
     */
    private $companyRepo;

    /**
     * @var Users
     */
    private $userRepo;

    /**
     * Constructor: inject dependencies and apply filters.
     *
     * @param Companies $companyRepo
     * @param Users     $userRepo
     */
    public function __construct(Companies $companyRepo, Users $userRepo)
	{
		$this->companyRepo = $companyRepo;
		$this->userRepo    = $userRepo;

		// check if user is linked to a company
		$this->middleware('ownership.company', ['except' => 'index']);
	}

	/**
	 * Show company connected to the user.
     *
     * @return \Illuminate\View\View
	 */
	public function index()
	{
		$data['company'] = $this->userRepo->getCompany(Sentry::getUser()->getId());

		return view('company.profile.overview', $data);
	}

	/**
	 * Profile overview.
     *
     * @param $company_id
     *
     * @return \Illuminate\View\View
	 */
	public function show($company_id)
	{
		$data['company'] = $this->companyRepo->findById($company_id);

		return view('company.profile.show', $data);
	}

	/**
	 * Display 'Edit basic data' from.
     *
     * @param $company_id
     *
     * @return \Illuminate\View\View
	 */
	public function editBasics($company_id)
	{
		$data['company'] = $this->companyRepo->findById($company_id);

		return view('company.profile.edit_basics', $data);
	}

	/**
	 * Process editing basic data.
     *
     * @param UpdateProfileRequest $request
     * @param                       $company_id
     *
     * @return \Illuminate\Http\RedirectResponse
	 */
	public function updateBasics(UpdateProfileRequest $request, $company_id)
	{
        $request->persist($this->companyRepo, $company_id);

		return redirect('company/profile/'. $company_id .'/show');
	}

    /**
     * Display 'Edit contacts' from.
     *
     * @param $company_id
     *
     * @return \Illuminate\View\View
     */
    public function editContacts($company_id)
	{
		$data['company'] = $this->companyRepo->findById($company_id);
		
		return view('company.profile.edit_contacts', $data);
	}

    /**
     * Process editing contacts.
     *
     * @param UpdateContactsRequest $request
     * @param                       $company_id
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function updateContacts(UpdateContactsRequest $request, $company_id)
	{
        $request->persist($this->companyRepo, $company_id);

		return redirect('company/profile/'. $company_id .'/show');
	}

	/**
	 * Display 'Edit logo' from.
     *
     * @param int $company_id
     *
     * @return \Illuminate\View\View
	 */
	public function editLogo($company_id)
	{
		$data['company'] = $this->companyRepo->findById($company_id);
		
		return view('company.profile.edit_logo', $data);
	}

	/**
	 * Upload logo.
     *
     * @param UploadLogoRequest $request
     * @param $company_id
     *
     * @return \Illuminate\Http\RedirectResponse
	 */
	public function updateLogo(UploadLogoRequest $request, $company_id)
	{
        $request->persist($this->companyRepo, $company_id);

		return redirect('company/profile/'. $company_id .'/edit-logo');
	}

	/**
	 * Delete logo.
     *
     * @param $company_id
     *
     * @return \Illuminate\Http\RedirectResponse
	 */
	public function deleteLogo($company_id)
	{
		$company = $this->companyRepo->findById($company_id);

		$filename = $company->logo;

        if (empty($filename)) {
			notify('error', 'logo_deleted');
            return redirect('company/profile/'. $company_id .'/edit-logo');
        }

		// delete logo in the database
		$company->update(['logo' => null]);

		// delete files
		\File::delete('uploads/logos/original/' . $filename);
		\File::delete('uploads/logos/medium/' . $filename);

		notify('success', 'logo_deleted');

		return redirect('company/profile/'. $company_id .'/edit-logo');
	}
}