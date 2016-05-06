<?php

use Illuminate\Database\Migrations\Migration;

class CreateCitiesTable extends Migration {

	public function up()
	{
		Schema::create('cities', function($table){
			$table->increments('id');
			$table->string('name');
			$table->string('slug');
			$table->text('description');
			
			$table->text('meta_description');
			$table->text('keywords');
		});
	}

	public function down()
	{
		Schema::drop('cities');
	}
}