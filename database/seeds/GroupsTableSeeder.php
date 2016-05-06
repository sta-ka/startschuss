<?php

use Illuminate\Database\Seeder;

class GroupsTableSeeder extends Seeder {

	public function run()
	{
		// create groups
		Sentry::createGroup(array('name' => 'admin'));
		Sentry::createGroup(array('name' => 'organizer'));
		Sentry::createGroup(array('name' => 'company'));
		Sentry::createGroup(array('name' => 'applicant'));

	}
}