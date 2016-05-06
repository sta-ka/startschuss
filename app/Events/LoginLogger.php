<?php namespace App\Events;

use App\Models\User\Login\DbLoginRepository as Login;

class LoginLogger {

    /**
     * @var Login
     */
    private $loginRepo;

    /**
     * Constructor: inject dependencies.
     *
     * @param Login $loginRepo
     */
    public function __construct(Login $loginRepo)
    {
        $this->loginRepo = $loginRepo;
    }

    /**
     * Write entry about login success in login table.
     *
     * @param string      $username
     * @param bool        $success
     * @param string|bool $comment
     * @param int|bool    $user_id
     */
    public function handle($username, $success, $comment = false, $user_id = false)
    {
        $data = [
            'username'   => $username,
            'user_id'    => $user_id ? $user_id : null,
            'ip_address' => $_SERVER['REMOTE_ADDR'],
            'success'    => $success,
            'comment'    => $comment ? $comment : null
        ];

        $this->loginRepo->create($data);
    }

}