<?php namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Company\Company;

class ImportCompaniesCommand extends Command {

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'import:companies';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Import companies from a file.';

	/**
	 * Execute the console command.
	 */
	public function handle()
	{
		$this->info('You are about to import new companies to the database.' . "\n");

        $filename = $this->ask('Give the name of the file.');

		$this->checkFile($filename);

		$companies = file('resources/data/companies/' . $filename);

		if ($this->confirm('Do you want to import ' . count($companies) . ' new companies? [yes|no]') != 'yes') {
            $this->error('Operation aborted.');
            return;
        }

        $this->createCompanies($companies);

        $this->info(count($companies) . ' companies successfully imported.');
	}

    /**
     * Check file.
     *
     * @param $filename
     *
     * @return bool
     */
    private function checkFile($filename)
    {
        if (empty($filename) || !file_exists('resources/data/companies/' . $filename)) {
            $this->error('Operation cancelled - invalid file given.');
            exit;
        }
    }

    /**
     * Create companies in database.
     *
     * @param $companies
     */
    private function createCompanies($companies)
    {
        foreach ($companies as $company) {
            list($name, $full_name, $slug) = explode(';', trim($company));

            $data = [
                'user_id'   => 0,
                'name'      => $name,
                'full_name' => $full_name,
                'slug'      => $slug
            ];

            Company::create($data);
        }
    }


}