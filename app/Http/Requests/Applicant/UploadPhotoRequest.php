<?php namespace App\Http\Requests\Applicant;

use App\Http\Requests\Request;
use App\Http\Requests\HandleImage;

class UploadPhotoRequest extends Request {

    use HandleImage;

    /**
     * The input keys that should not be flashed on redirect.
     *
     * @var array
     */
    protected $dontFlash = ['photo'];
	
	/**
	 * Get the validation rules that apply to the request.
	 *
	 * @return array
	 */
	public function rules()
	{
		return [
			'photo' => 'required|image|max:1000'
		];
	}

    /**
     * Persist data.
     *
     * @param object   $applicantRepo
     *
     * @return bool|int
     */
    public function persist($applicantRepo)
    {
        $applicant = $applicantRepo->findByUserId(\Sentry::getUser()->getId());

        $filename = $this->createFilename();

        // resize image	and save them
        $this->uploadImage(\Input::file('photo'), 100, 50, 'uploads/photos/medium/' . $filename);
        $this->uploadImage(\Input::file('photo'), 50, 25, 'uploads/photos/small/' . $filename);

        \Input::file('photo')->move('uploads/photos/original/', $filename);

        // Save photo in the database
        return $applicant->update(['photo' => $filename]);
    }

    /**
     * Create a filename and make it lower case.
     *
     * @return string
     */
    protected function createFilename()
    {
        $extension = \File::extension(\Input::file('photo')->getClientOriginalName());
        $filename = $this->applicant->slug . '_' . date('U') . '.' . $extension;

        return \Str::lower($filename);
    }
}
