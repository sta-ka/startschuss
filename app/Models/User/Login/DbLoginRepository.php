<?php namespace App\Models\User\Login;

class DbLoginRepository implements LoginRepository
{

    /**
     * Create a new entry.
     *
     * @param array $data
     *
     * @return static
     */
    public function create(array $data)
    {
        return Login::create($data);
    }

    /**
     * Get all login.
     *
     * @param      $limit
     * @param bool $successful
     *
     * @return mixed
     */
    public function getAll($limit, $successful = true)
    {
        $query = Login::take($limit)
            ->orderBy('created_at', 'desc');

        if ($successful == false) {
            $query->where('success', 0);
        }

        return $query->get(['username', 'ip_address', 'success', 'comment', 'created_at']);
    }

}