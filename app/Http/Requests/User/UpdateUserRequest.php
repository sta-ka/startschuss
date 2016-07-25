<?php namespace App\Http\Requests\User;

use App\Http\Requests\Request;

class UpdateUserRequest extends Request {

	/**
	 * Get the validation rules that apply to the request.
	 *
	 * @return array
	 */
	public function rules()
	{
		$user_id = $this->route()->parameter('id');

		return [
			'username' => 'required|min:3|alpha_dot|unique:users,username,'. $user_id,
			'email'    => 'required|email|unique:users,email,'. $user_id
		];
	}


    /**
     * Persist data.
     *
     * @param object    $userRepo
     * @param int       $user_id
     *
     * @return bool|int
     */
    public function persist($userRepo, $user_id)
    {
        $user = $userRepo->findById($user_id);

        $data = [
            'username'	=> $this->request->get('username'),
            'email'		=> $this->request->get('email')
        ];

        return $user->update($data);
    }

}
