<?php namespace App\Services\Creator;

use App\Models\Misc\City\CityRepository;

class CityCreator extends Creator {

	private $cityRepo;

    /**
     * @param CityRepository $city
     */
    public function __construct(CityRepository $city)
	{
		$this->cityRepo = $city;
	}

    /**
     * Perform update.
     *
     * @param array $input
     * @param int   $city_id
     *
     * @return bool|int
     */
    public function updateData($input, $city_id)
	{
		$city = $this->cityRepo->findById($city_id);

		$data = [
			'name'				=> $input['name'],
			'slug'				=> $input['slug'],
			'description'		=> \Purifier::clean($input['description']),
			'meta_description'	=> $input['meta_description'],
			'keywords'			=> $input['keywords']
		];

		return $city->update($data);

	}
}