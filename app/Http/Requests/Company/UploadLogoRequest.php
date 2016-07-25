<?php namespace App\Http\Requests\Company;

use App\Http\Requests\Request;
use App\Http\Requests\HandleImage;


class UploadLogoRequest extends Request {

    use HandleImage;

    protected $dontFlash = ['logo'];
	
	/**
	 * Get the validation rules that apply to the request.
	 *
	 * @return array
	 */
	public function rules()
	{
		return [
			'logo' => 'required|image|max:1000',
		];
	}

    /**
     * Persist data.
     *
     * @param object $companyRepo
     * @param int    $company_id
     *
     * @return static
     */
    public function persist($companyRepo, $company_id)
    {
        $company = $companyRepo->findById($company_id);

        $filename = $this->createFilename($company);

        // resize image	and save it
        $this->uploadImage(\Input::file('logo'), 100, 50, 'uploads/logos/medium/' . $filename);
        \Input::file('logo')->move('uploads/logos/original/', $filename);

        return $company->update(['logo' => $filename]);
    }

}
