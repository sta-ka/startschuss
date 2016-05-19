<?php

use Illuminate\Database\Seeder;

class GroupsTableSeeder extends Seeder {

	public function run()
	{
		Sentry::createGroup(['name' => 'admin']);
		Sentry::createGroup(['name' => 'organizer']);
		Sentry::createGroup(['name' => 'company']);
		Sentry::createGroup(['name' => 'applicant']);

	}
}