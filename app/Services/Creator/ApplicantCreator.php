<?php namespace App\Services\Creator;

use App\Models\Applicant\ApplicantRepository;

class ApplicantCreator extends Creator {

	private $applicantRepo;

	private $applicant;

    /**
     * @param ApplicantRepository $applicantRepo
     */
    public function __construct(ApplicantRepository $applicantRepo)
	{
		$this->applicantRepo = $applicantRepo;

        $this->applicant = $this->applicantRepo->findByUserId(\Sentry::getUser()->getId());
    }

    /**
     * Perform update.
     *
     * @param array $input
     *
     * @return bool|int
     */
    public function editBasics($input)
    {
        $data = [
            'name'		=> $input['name'],
            'birthday'	=> $input['birthday']
        ];

        return $this->applicant->update($data);
    }


    /**
     * Perform update.
     *
     * @param array $input
     *
     * @return bool|int
     */
    public function editContacts($input)
	{
		$data = [
			'email'	=> $input['email'],
			'phone'	=> $input['phone']
			];

		return  $this->applicant->update($data);
	}


    /**
     * Resize image and perform update.
     *
     * @return bool|int
     */
    public function processPhoto()
	{
        $filename = $this->createFilename();

        // resize image	and save them
        $this->uploadImage(\Input::file('photo'), 100, 50, 'uploads/photos/medium/' . $filename);
        $this->uploadImage(\Input::file('photo'), 50, 25, 'uploads/photos/small/' . $filename);

		\Input::file('photo')->move('uploads/photos/original/', $filename);

		// Save photo in the database
		return $this->applicant->update(['photo' => $filename]);
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