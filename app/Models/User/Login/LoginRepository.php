<?php namespace App\Models\User\Login;

interface LoginRepository {

    /**
     * Create a new entry.
     *
     * @param array $data
     *
     * @return static
     */
    public function create(array $data);

    /**
     * Get all login.
     *
     * @param int  $limit
     * @param bool $successful
     *
     * @return mixed
     */
    public function getAll($limit, $successful = true);

}