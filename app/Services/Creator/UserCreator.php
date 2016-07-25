<?php namespace App\Services\Creator;

use App\Models\User\UserRepository as Users;

use App\Services\Mailers\UserMailer;

class UserCreator extends Creator {

	private $userRepo;

    /**
     * @param Users $userRepo
     */
    public function __construct(Users $userRepo)
	{
		$this->userRepo = $userRepo;
	}

    /**
     * Register user and send mail.
     *
     * @param array $input
     *
     * @return bool
     */
    public function register($input)
	{
		$credentials = [
			'username'		=> $input['username'],
			'email'			=> $input['email'],
			'password'  	=> $input['password']
			];

		// create a new, inactive user in the user table
		$user = \Sentry::register($credentials, false);

        if ($user == false)
            return false;

        $this->createApplicant($user);

        // create entry in the table users_groups
        $group = \Sentry::findGroupByName('applicant');
        $user->addGroup($group);

        $this->sendActivationMail($user);

        event('log.event', ['Neue Registrierung: ' . $input['username']]);

        return true;
    }

    /**
     * Perform create.
     *
     * @param array $input
     *
     * @return Object $user
     */
    public function create($input)
	{
		$credentials = [
			'username'		=> $input['username'],
			'email'			=> $input['email'],
			'password'  	=> 'staka365'
			];

		// creates a new user in the user table
		$user = \Sentry::register($credentials, true);

		// create entry in the table users_groups
		$group = \Sentry::getGroupProvider()->findById($input['group']);
		$user->addGroup($group);

		if ($input['group'] == 4) // 4 = applicant user
            $this->createApplicant($user);

		return $user;
	}

    /**
     * Perform update.
     *
     * @param array $input
     * @param int   $user_id
     *
     * @return bool|int
     */
    public function edit($input, $user_id)
	{
		$user = $this->userRepo->findById($user_id);

		$data = [
			'username'	=> $input['username'],
			'email'		=> $input['email']
		];

		return $user->update($data);
	}

    /**
     * Perform update.
     *
     * @param array $input
     *
     * @return bool|int
     */
    public function changePassword($input)
	{
        $user = \Sentry::getUser();

		if ($user->checkPassword($input['oldpassword']))		{
			return $user->update(['password' => $input['newpassword']]);
		}

		return false;
	}

    /**
     * Perform update.
     *
     * @param array $input
     *
     * @return bool|int
     */
    public function changeEmail($input)
	{
        $user = \Sentry::getUser();

		if ($user->checkPassword($input['password'])) 		{
			return $user->update(['email' => $input['email']]);
		}

		return false;
	}

    /**
     * Send activation mail.
     *
     * @param $user
     */
    private function sendActivationMail($user)
    {
        $data['activation_code'] = base64_encode($user->id . '/' . $user->getActivationCode());

        (new UserMailer($user))
            ->sendActivationCode($data)->deliver(false); // TODO: No return value
    }

    /**
     * @param $user
     */
    private function createApplicant($user)
    {
        $applicant = \App::make('App\Models\Applicant\ApplicantRepository');
        $applicant->create(['user_id' => $user->getId()]);
    }
}