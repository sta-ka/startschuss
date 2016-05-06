<?php

use Illuminate\Database\Seeder;

class JobsTableSeeder extends Seeder {

	public function run()
	{
		foreach(range(1, 20) as $i)
		{
			$data = array(
				'company_id'		=> $i,
				'title'				=> 'Bester Job '.$i,
				'slug'				=> 'bester-job-'.$i,
				'location' 			=> 'Berlin',
				'type' 				=> 'Vollzeit',
			 	'active'	 		=> 1,
			 	'approved'	 		=> 1
			);

            \App\Models\Company\Job\Job::create($data);
		}

		$data = array(
			'company_id'		=> 21,
			'title'				=> 'Bester Job 21',
			'slug'				=> 'bester-job-21',
			'location' 			=> 'Köln',
			'type' 				=> 'Vollzeit',
			'active'	 		=> 1,
			'approved'	 		=> 1
		);
			
		\App\Models\Company\Job\Job::create($data);

		$data = array(
			'company_id'		=> 22,
			'title'				=> 'Bester Job 22',
			'slug'				=> 'bester-job-22',
			'location' 			=> 'Köln',
			'type' 				=> 'Teilzeit',
			'active'	 		=> 1,
			'approved'	 		=> 1
		);
			
		\App\Models\Company\Job\Job::create($data);

	}
}