<?php namespace App\Models\Misc\Statistic;

class DbStatisticRepository implements StatisticRepository {

    /**
     * Create a new entry.
     *
     * @param array $data
     *
     * @return static
     */
    public function create(array $data)
    {
        return Statistic::create($data);
    }

    /**
     * Get searches.
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getSearches()
	{
		return Statistic::where('type', 'search')
				->orderBy('created_at', 'desc')
				->get();
	}

    /**
     * Get popular searches.
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getPopularSearches()
	{
        return Statistic::select('ip_address', 'info', \DB::raw('COUNT(info) as total_searches'))
                ->where('type', 'search')
                ->groupBy('info')
                ->orderBy('total_searches', 'desc')
                ->take(10)
                ->get();
	}

}