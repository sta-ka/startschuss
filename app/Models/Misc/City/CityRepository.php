<?php namespace App\Models\Misc\City;

interface CityRepository {

	/**
	 * Get all cities.
	 */
	public function getAll();

	/**
	 * Get city by slug.
     *
     * @param string $slug
     *
     * @return \Illuminate\Database\Eloquent\Model
	 */
	public function findBySlug($slug);

	/**
	 * Get city by ID.
     *
     * @param int $id
     *
     * @return \Illuminate\Database\Eloquent\Model
	 */
	public function findById($id);}