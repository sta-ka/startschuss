<?php namespace App\Http\Requests\User;

use App\Http\Requests\Request;

class CreateUserRequest extends Request {

	/**
	 * Get the validation rules that apply to the request.
	 *
	 * @return array
	 */
	public function rules()
	{
		return [
			'username'	=> 'required|min:3|alpha_dot|unique:users,username',
			'email'		=> 'required|email|unique:users,email',
			'group'  	=> 'required|in:2,3,4'
		];
	}

    /**
     * Persist data.
     *
     * @return bool|int
     */
    public function persist()
    {
        $credentials = [
            'username'		=> $this->request->get('username'),
            'email'			=> $this->request->get('email'),
            'password'  	=> 'staka365'
        ];

        // creates a new user in the user table
        $user = \Sentry::register($credentials, true);

        // create entry in the table users_groups
        $group = \Sentry::getGroupProvider()->findById($this->request->get('group'));
        $user->addGroup($group);

        if ($this->request->get('group') == 4) // 4 = applicant user
            $this->createApplicant($user);

        return $user;
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
