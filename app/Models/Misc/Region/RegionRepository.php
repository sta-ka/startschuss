<?php namespace App\Models\Misc\Region;

interface RegionRepository {

	/**
	 * Get all regions.
     *
     * @return \Illuminate\Database\Eloquent\Model
	 */
	public function getAll();

	/**
	 * Get an array of all regions with the specified columns and keys.
     *
     * @param string $column
     * @param string $key
     *
     * @return array
	 */
	public function lists($column, $key);

	/**
	 * Get region by ID.
     *
     * @param int $region_id
     *
     * @return \Illuminate\Database\Eloquent\Model
	 */
	public function findById($region_id);

	/**
	 * Get region by slug.
     *
     * @param string $slug
     *
     * @return \Illuminate\Database\Eloquent\Model
	 */
	public function findBySlug($slug);

	/**
	 * Get all visible and upcoming events for a specific region.
     *
     * @param int $region_id
     * @param int $limit
     *
     * @return \Illuminate\Database\Eloquent\Model
	 */
	public function getEventsInRegion($region_id, $limit);


}