<?php namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use App\Models\Company\CompanyRepository as Companies;
use App\Services\Creator\CompanyCreator;

use App\Models\User\UserRepository as Users;

use App\Http\Requests\Company\CreateCompanyRequest;
use App\Http\Requests\Company\UpdateGeneralDataRequest;
use App\Http\Requests\Company\UpdateProfileRequest;
use App\Http\Requests\Company\UpdateContactsRequest;
use App\Http\Requests\Company\UploadLogoRequest;

use Input;
use Sentry;

/**
 * Class CompaniesController
 *
 * @package App\Http\Controllers\Admin
 */
class CompaniesController extends Controller {

    /**
     * @var Companies
     */
    private $companyRepo;

    /**
     * @var Users
     */
    private $userRepo;

	/**
	 * Constructor: inject dependencies.
     *
     * @param Companies $companyRepo
     * @param Users $userRepo
	 */
	public function __construct(Companies $companyRepo, Users $userRepo)
	{
		$this->companyRepo = $companyRepo;
		$this->userRepo = $userRepo;
	}

	/**
	 * 'Companies overview' page.
     *
     * @return \Illuminate\View\View
	 */
	public function index()
	{
		$data['companies'] = $this->companyRepo->getAll(true); // get all companies including trashed ones

		return view('admin.companies.show', $data);
	}

	/**
	 * Display company profile.
     *
     * @param int $company_id
     *
     * @return \Illuminate\View\View
	 */
	public function show($company_id)
	{
		$data['company']	= $this->companyRepo->findById($company_id);
		$data['users_list']	= $this->userRepo->lists('username', 'id', 3);
		$data['users'] 		= $this->companyRepo->getUsers($company_id);

		return view('admin.companies.profile.show', $data);
	}

	/**
	 * Display 'New company' form.
     *
     * @return \Illuminate\View\View
	 */
	public function newCompany()
	{
		return view('admin.companies.new');
	}

	/**
	 * Create a new company.
     *
     * @param CreateCompanyRequest $request
     *
     * @return \Illuminate\Http\RedirectResponse
	 */
	public function create(CreateCompanyRequest $request)
	{
		$success = (new CompanyCreator($this->companyRepo))
					->createCompany($request->all());

		notify($success, 'company_created');

		return redirect('admin/companies');
	}

	/**
	 * Link a company to a user.
     *
     * @param int $company_id
     *
     * @return \Illuminate\Http\RedirectResponse
	 */
	public function addLinkage($company_id)
	{
		$user_id = Input::get('user_id');
		$user = Sentry::findUserByID($user_id);

		if ( ! $user->inGroup(Sentry::findGroupByName('company'))) {
			notify('error', 'profile_update');
			return redirect('admin/companies/'. $company_id .'/show');
		}

		$success = $this->companyRepo->addLinkage($company_id, $user_id);
		notify($success, 'profile_update');

		return redirect('admin/companies/'. $company_id .'/show');
	}

	/**
	 * Delete linkage between company and user.
     *
     * @param int $company_id
     * @param int $user_id
     *
     * @return \Illuminate\Http\RedirectResponse
	 */
	public function deleteLinkage($company_id, $user_id)
	{
		$this->companyRepo->deleteLinkage($company_id, $user_id);

		return redirect('admin/companies/'. $company_id .'/show');
	}

	/**
	 * Display 'Edit general data' form.
     *
     * @param int $company_id
     *
     * @return \Illuminate\View\View
	 */
	public function editGeneralData($company_id)
	{
		$data['company'] = $this->companyRepo->findById($company_id);

		return view('admin.companies.profile.edit_general_data', $data);
	}

	/**
	 * Process editing general data.
     *
     * @param UpdateGeneralDataRequest $request
     * @param int $company_id
     *
     * @return \Illuminate\Http\RedirectResponse
	 */
	public function updateGeneralData(UpdateGeneralDataRequest $request, $company_id)
	{
		(new CompanyCreator($this->companyRepo))
        	->editGeneralData($request->all(), $company_id);

		return redirect('admin/companies/'. $company_id .'/show');
	}

	/**
	 * Display 'Edit profile' form.
     *
     * @param int $company_id
     *
     * @return \Illuminate\View\View
	 */
	public function editProfile($company_id)
	{
		$data['company'] = $this->companyRepo->findById($company_id);
		
		return view('admin.companies.profile.edit_profile', $data);
	}

	/**
	 * Process editing profile.
     *
     * @param UpdateProfileRequest $request
     * @param int $company_id
     *
     * @return \Illuminate\Http\RedirectResponse
	 */
	public function updateProfile(UpdateProfileRequest $request, $company_id)
	{
		(new CompanyCreator($this->companyRepo))
        		->editProfile($request->all(), $company_id);

		return redirect('admin/companies/'. $company_id .'/show');
	}

	/**
	 * Display 'Edit contacts' from.
     *
     * @param int $company_id
     *
     * @return \Illuminate\View\View
	 */
	public function editContacts($company_id)
	{
		$data['company'] = $this->companyRepo->findById($company_id);
		
		return view('admin.companies.profile.edit_contacts', $data);
	}

	/**
	 * Process editing contacts.
     *
     * @param UpdateContactsRequest $request
     * @param int $company_id
     *
     * @return \Illuminate\Http\RedirectResponse
	 */
	public function updateContacts(UpdateContactsRequest $request, $company_id)
	{
		(new CompanyCreator($this->companyRepo))
        	->editContacts($request->all(), $company_id);

		return redirect('admin/companies/'. $company_id .'/show');
	}

	/**
	 * Display 'Edit company logo' form.
     *
     * @param int $company_id
     *
     * @return \Illuminate\View\View
	 */
	public function editLogo($company_id)
	{
		$data['company'] = $this->companyRepo->findById($company_id);
		
		return view('admin.companies.profile.edit_logo', $data);
	}

	/**
	 * Upload logo.
     *
     * @param UploadLogoRequest $request
     * @param int $company_id
     *
     * @return \Illuminate\Http\RedirectResponse
	 */
	public function updateLogo(UploadLogoRequest $request, $company_id)
	{
		(new CompanyCreator($this->companyRepo))
			->processLogo($company_id);

		return redirect('admin/companies/'. $company_id .'/edit-logo');
	}

	/**
	 * Delete logo.
     *
     * @param int $company_id
     *
     * @return \Illuminate\Http\RedirectResponse
	 */
	public function deleteLogo($company_id)
	{
		$company = $this->companyRepo->findById($company_id);

		if (empty($company->logo)) {
			notify('error', 'logo_deleted');
            return redirect('admin/companies/' . $company_id . '/edit-logo');
        }

        $this->deleteLogoFile($company);

		notify('success', 'logo_deleted');
        return redirect('admin/companies/'. $company_id .'/edit-logo');
	}

	/**
	 * Delete company - Soft delete is enabled
     *
     * @param int $company_id
     *
     * @return \Illuminate\Http\RedirectResponse
	 */
	public function delete($company_id)
	{
		$company = $this->companyRepo->findById($company_id);

		if (! $company->deleted_at) { // check if company is not soft-deleted
			$success = $company->delete();
			notify($success, 'company_delete');

			return redirect('admin/companies');
        }

        $company->forceDelete();

        if ($company->logo) {
            $this->deleteLogoFile($company);
        }

        $company->participants()->detach(); // delete all entries from participants table

        $company->users()->detach(); // delete all links to users

        $company->jobs()->delete(); // delete all jobs posted by this company

		notify('success', 'company_delete');

		return redirect('admin/companies');
	}

	/**
	 * Restore company - Restore soft deleted company
     *
     * @param int $company_id
     *
     * @return \Illuminate\Http\RedirectResponse
	 */
	public function restore($company_id)
	{
		$company = $this->companyRepo->findById($company_id);

		if ($company->deleted_at) {
            $company->restore();
        }

		return redirect('admin/companies/'. $company_id .'/show');
	}

    /**
     * Delete logo from database and in filesystem
     *
     * @param $company
     */
    private function deleteLogoFile($company)
    {
        $filename = $company->logo;

        $company->update(['logo' => null]);

        \File::delete('uploads/logos/original/' . $filename);
        \File::delete('uploads/logos/medium/' . $filename);
    }
}