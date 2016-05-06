<?php namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\User\User;

use Symfony\Component\Console\Helper\Table;
use Symfony\Component\Console\Output\ConsoleOutput;

class UserSuspendCommand extends Command {

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'user:suspend';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Suspend or unsuspend user.';

	/**
	 * Execute the console command.
	 */
	public function handle()
	{
        $user_id = $this->ask('Suspend user by user id - User ID?');
		$user = $this->getUserByUserId($user_id);

		if (count($user) == 0) {
            $this->error('No user found.');
            return;
        }

        $this->printUserData($user);

        $throttle = \Sentry::findThrottlerByUserId($user_id);

        if ($throttle->isBanned()) {
            $this->info("User is already banned.");

            if ($this->confirm('Unsuspend user?')) {
                $throttle->unban();
                $this->info("User successful unsuspended.");
                return;
            }
        } else {
            if ($this->confirm('Suspend user?')) {
                $throttle->ban();
                $this->info("User successful suspended.");
                return;
            }
        }

        $this->info("Operation aborted");
	}

    /**
     * Print user data to console.
     *
     * @param $user
     */
    private function printUserData($user)
    {
        $this->info("Found a user:");

        $table = new Table(new ConsoleOutput);

        $table->setHeaders(['id', 'name', 'e-mail', 'activated', 'last_login', 'created_at'])
            ->setRows($user->toArray())
            ->render();
    }

    /**
     * @param $user_id
     *
     * @return mixed
     */
    private function getUserByUserId($user_id)
    {
        return User::join('users_groups', 'users.id', '=', 'users_groups.user_id')
            ->where('users.id', $user_id)
            ->get(['id', 'username', 'email', 'activated', 'last_login', 'created_at']);
    }
}
