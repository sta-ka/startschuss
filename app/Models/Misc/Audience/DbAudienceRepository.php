<?php namespace App\Models\Misc\Audience;

class DbAudienceRepository implements AudienceRepository {

    /**
     * Get an array of all audiences with the specified columns and keys.
     *
     * @param string $column
     * @param string $key
     *
     * @return array
	 */
	public function lists($column, $key)
	{
		return Audience::lists($column, $key);
	}

}