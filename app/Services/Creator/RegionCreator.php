<?php namespace App\Services\Creator;

use App\Models\Misc\Region\RegionRepository;

class RegionCreator extends Creator {

	private $regionRepo;

    /**
     * @param RegionRepository $regionRepo
     */
    public function __construct(RegionRepository $regionRepo)
	{
		$this->regionRepo = $regionRepo;
	}

    /**
     * Perform update.
     *
     * @param array $input
     * @param int   $region_id
     *
     * @return bool|int
     */
    public function updateData($input, $region_id)
	{
		$region = $this->regionRepo->findById($region_id);

		$data = [
			'name'				=> $input['name'],
			'slug'				=> $input['slug'],
			'description'		=> \Purifier::clean($input['description']),
			'meta_description'	=> $input['meta_description'],
			'keywords'			=> $input['keywords']
		];

		return $region->update($data);

	}
}