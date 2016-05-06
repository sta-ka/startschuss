<?php namespace App\Console\Commands;

use Illuminate\Console\Command;

use App\Models\User\Login\LoginRepository as Logins;

use Symfony\Component\Console\Helper\Table;
use Symfony\Component\Console\Output\ConsoleOutput;

class UserLoginsCommand extends Command {

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'user:logins';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Shows last 100 logins.';

    /**
     * @var Logins
     */
    private $loginRepo;

	/**
	 * Create a new command instance.
     *
     * @param $loginRepo Logins
	 */
	public function __construct(Logins $loginRepo)
	{
		parent::__construct();

		$this->loginRepo = $loginRepo;
	}

	/**
	 * Execute the console command.
	 */
	public function handle()
	{
        $successful = true;

		if ($this->ask('Only show unsuccessful logins? [yes|no]') == 'yes') {
			$successful = false;
		}

        $logins = $this->loginRepo->getAll(100, $successful);

        if (count($logins) == 0 ) {
            $this->info('There are no logins.');
            return;
        }

        $this->printOutput($logins);
	}

    /**
     * Print login data to console
     *
     * @param $logins
     */
    private function printOutput($logins)
    {
        $this->info('Last 100 Logins ordered by date.');
        echo "\n";

        $table = new Table(new ConsoleOutput);

        $table->setHeaders(['username', 'ip_address', 'success', 'comment', 'login_at'])
            ->setRows($logins->toArray())
            ->render();
    }

}
