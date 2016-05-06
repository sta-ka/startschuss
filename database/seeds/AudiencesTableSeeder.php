<?php

use Illuminate\Database\Seeder;

class AudiencesTableSeeder extends Seeder {

	public function run()
	{
		DB::table('audiences')->insert(array(
			array('name' => 'Alle'),                             
			array('name' => 'Wirtschaft'),                             
			array('name' => 'Recht'),                             
			array('name' => 'Naturwissenschaften'),                             
			array('name' => 'Geisteswissenschaften'),                             
			array('name' => 'Informatik'),                             
			array('name' => 'Technik')                          
			));

	}
}