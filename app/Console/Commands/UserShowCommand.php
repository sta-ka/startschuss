<?php namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\User\User;

use Symfony\Component\Console\Helper\Table;
use Symfony\Component\Console\Output\ConsoleOutput;

class UserShowCommand extends Command {

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'user:show';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Shows all user based on search criteria.';

    /**
     * Array of available groups.
     *
     * @var array
     */
    protected $groups  = [
        '1' => 'admins',
        '2' => 'organizers',
        '3' => 'companies',
        '4' => 'applicants',
    ];

	/**
	 * Execute the console command.
	 */
	public function handle()
	{
        $this->info('Show users based on group:');

        $group_name = $this->choice('Choose the group id:', $this->groups);
		$users = $this->getUsersInGroup($group_name);

		if (count($users) == 0) {
            $this->error('No users found.');
            return;
        }

        $this->printOutput($users, $group_name);
	}

    /**
     * Print found users to console.
     *
     * @param $users
     * @param $group_name
     */
    private function printOutput($users, $group_name)
    {
        $this->info("All registered {$group_name}:");

        $table = new Table(new ConsoleOutput);

        $table->setHeaders(['id', 'name', 'e-mail', 'activated', 'last_login', 'created_at'])
            ->setRows($users->toArray())
            ->render();
    }

    /**
     * Get users based on selected group.
     *
     * @param $group_name
     *
     * @return mixed
     */
    private function getUsersInGroup($group_name)
    {
        return User::join('users_groups', 'users.id', '=', 'users_groups.user_id')
            ->where('users_groups.group_id', array_search($group_name, $this->groups))
            ->get(['id', 'username', 'email', 'activated', 'last_login', 'created_at']);
    }
}
