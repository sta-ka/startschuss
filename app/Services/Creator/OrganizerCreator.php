<?php namespace App\Services\Creator;

use App\Models\Organizer\OrganizerRepository;

class OrganizerCreator extends Creator {

	private $organizerRepo;

    /**
     * @param OrganizerRepository $organizerRepo
     */
    public function __construct(OrganizerRepository $organizerRepo)
	{
		$this->organizerRepo = $organizerRepo;
	}

    /**
     * Perform create.
     *
     * @param array $input
     *
     * @return static
     */
    public function createOrganizer($input)
	{
		$data = [
			'name'		=> $input['name'],
			'slug'		=> $input['slug']
		];

		return $this->organizerRepo->create($data);
	}

    /**
     * Perform update.
     *
     * @param array $input
     * @param int   $organizer_id
     *
     * @return bool|int
     */
    public function editGeneralData($input, $organizer_id)
	{
		$organizer = $this->organizerRepo->findById($organizer_id);

		$data = [
			'name'		=> $input['name'],
			'featured'	=> \Input::get('featured', false),
			'premium'	=> \Input::get('premium', false)
		];

		return $organizer->update($data);
	}

    /**
     * Perform update.
     *
     * @param array $input
     * @param int   $organizer_id
     *
     * @return bool|int
     */
    public function editProfile($input, $organizer_id)
	{
		$organizer = $this->organizerRepo->findById($organizer_id);

		$data = [
			'address1'	=> $input['address1'],
			'address2'	=> $input['address2'],
			'address3'	=> $input['address3'],
			'profile'	=> \Purifier::clean($input['profile'])
		];

		return $organizer->update($data);	
	}

    /**
     * Perform update.
     *
     * @param array $input
     * @param int   $organizer_id
     *
     * @return bool|int
     */
    public function editContacts($input, $organizer_id)
	{
		$organizer = $this->organizerRepo->findById($organizer_id);

		$data = [
			'website' 	=> $input['website'], 
			'facebook' 	=> $input['facebook'], 
			'twitter' 	=> $input['twitter']
		];
		
		return $organizer->update($data);	
	}

    /**
     * Perform update.
     *
     * @param array $input
     * @param int   $organizer_id
     *
     * @return bool|int
     */
    public function editSeoData($input, $organizer_id)
	{
		$organizer = $this->organizerRepo->findById($organizer_id);

		$data = [
			'slug' 				=> $input['slug'], 
			'meta_description' 	=> $input['meta_description'], 
			'keywords' 			=> $input['keywords']
		];
		
		return $organizer->update($data);
	}

    /**
     * Perform update.
     *
     * @param int   $organizer_id
     *
     * @return bool|int
     */
    public function processLogo($organizer_id)
	{
		$organizer = $this->organizerRepo->findById($organizer_id);

        $filename = $this->createFilename($organizer);

		// resize images and save them
		$this->uploadImage(\Input::file('logo'), 250, 125, 'uploads/logos/big/' . $filename);
		$this->uploadImage(\Input::file('logo'), 100, 50, 'uploads/logos/medium/' . $filename);
		$this->uploadImage(\Input::file('logo'), 50, 25, 'uploads/logos/small/' . $filename);

		\Input::file('logo')->move('uploads/logos/original/', $filename);

		return $organizer->update(['logo' => $filename]);
	}

}