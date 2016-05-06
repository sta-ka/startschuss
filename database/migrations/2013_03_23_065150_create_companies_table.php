<?php

use Illuminate\Database\Migrations\Migration;

class CreateCompaniesTable extends Migration {

	public function up()
	{
		Schema::create('companies', function($table) {
			$table->increments('id');
			
			$table->string('name');
			$table->text('profile');
			$table->string('full_name');
			$table->string('slug');
			$table->string('logo');
			$table->string('website');
			$table->string('facebook');
			$table->string('twitter');

			$table->boolean('featured');
			$table->boolean('premium');

			$table->softDeletes();
			$table->timestamps();
		});
	}

	public function down()
	{
		Schema::drop('companies');
	}

}