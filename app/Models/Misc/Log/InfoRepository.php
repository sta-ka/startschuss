<?php namespace App\Models\Misc\Log;

interface InfoRepository {

    /**
     * Get logins.
     *
     * @param int $limit
     *
     * @return \Illuminate\Database\Eloquent\Model
     */
	public function getAll($limit);

}