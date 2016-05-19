<?php
use Illuminate\Database\Seeder;

class CitiesTableSeeder extends Seeder {

	public function run()
	{
        /**
         * Note: Convert CSV files generated by Excel to UTF-8
         */

		// import city data
		$cities = file('resources/data/cities.txt');

		foreach($cities as $city)
		{
			list($name, $slug, $description, $meta_description, $keywords) = explode(';', trim($city));

			$data = [
				'name'				=> trim($name, '"'),
				'slug'				=> trim($slug, '"'),
				'description' 		=> trim($description, '"'),
			 	'meta_description' 	=> trim($meta_description, '"'),
			 	'keywords' 			=> trim($keywords, '"')
			];
			
			\App\Models\Misc\City\City::create($data);
		}
	}
}