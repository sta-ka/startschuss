<?php namespace App\Models\Misc\City;

class DbCityRepository implements CityRepository {

	/**
	 * Get all cities.
     *
     * @return \Illuminate\Database\Eloquent\Model
	 */
	public function getAll()
	{
		return City::all();
	}

	/**
	 * Get city by slug.
     *
     * @param string $slug
     *
     * @return \Illuminate\Database\Eloquent\Model
	 */
	public function findBySlug($slug)
	{
		return City::where('slug', $slug)
					->firstOrFail();
	}

	/**
	 * Get city by ID.
     *
     * @param int $id
     *
     * @return \Illuminate\Database\Eloquent\Model
	 */
	public function findById($id)
	{
		return City::findOrFail($id);
	}

}