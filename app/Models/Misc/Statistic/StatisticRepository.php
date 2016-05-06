<?php namespace App\Models\Misc\Statistic;

interface StatisticRepository {

    /**
     * Create a new entry.
     *
     * @param array $data
     *
     * @return static
     */
    public function create(array $data);

    /**
     * Get searches.
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
	public function getSearches();

    /**
     * Get popular searches.
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getPopularSearches();

}