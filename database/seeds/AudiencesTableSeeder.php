<?php

use Illuminate\Database\Seeder;

class AudiencesTableSeeder extends Seeder {

	public function run()
	{
		DB::table('audiences')->insert([
			['name' => 'Alle'],
			['name' => 'Wirtschaft'],
			['name' => 'Recht'],
			['name' => 'Naturwissenschaften'],
			['name' => 'Geisteswissenschaften'],
			['name' => 'Informatik'],
			['name' => 'Technik']
			]);

	}
}