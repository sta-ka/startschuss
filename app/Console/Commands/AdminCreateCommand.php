<?php namespace App\Console\Commands;

use Illuminate\Console\Command;

class AdminCreateCommand extends Command {

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
	protected $signature = 'admin:create';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Creates a new admin user.';

	/**
	 * Execute the console command.
	 */
	public function handle()
	{
		$this->info('You are about to create a new admin user.');
		
		$data = [
			'username' 	=> $this->ask('Username?'),
			'email'		=> $this->ask('Email?'),
			'password' 	=> $this->secret('Password?'),
			'confirm' 	=> $this->secret('Confirm Password!')
		];

        $this->validate($data);

        $this->registerUser($data);
	}

    /**
     * Register an activated admin user
     *
     * @param $data
     */
    private function registerUser($data)
    {
        unset($data['confirm']);

        $user = \Sentry::register($data, true);
        $group = \Sentry::findGroupByName('admin');
        $user->addGroup($group);

        $this->info('Admin user created successfully.');
    }

    /**
     * Validate data
     *
     * @param $data
     */
    private function validate($data)
    {
        \App::setLocale('en');

        $rules = [
            'username' => 'required|min:3|alpha_dot|unique:users,username',
            'email'    => 'required|email|unique:users,email',
            'password' => 'required|min:7|same:confirm',
            'confirm'  => ''
        ];

        $validator = \Validator::make($data, $rules);

        if ($validator->fails()) {
            foreach ($validator->messages()->getMessages() as $message) {
                $this->error($message[0]);
            }

            if ($this->ask('Do you want to try again? [yes|no]') == 'yes') {
                $this->handle();
            }

            exit;
        }
    }

}
