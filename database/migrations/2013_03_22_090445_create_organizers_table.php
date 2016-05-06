<?php

use Illuminate\Database\Migrations\Migration;

class CreateOrganizersTable extends Migration {

	public function up()
	{
		Schema::create('organizers', function($table) {
			$table->increments('id');

			$table->string('name');
			$table->text('profile');
			$table->string('address1');
			$table->string('address2');
			$table->string('address3');
			$table->string('logo');
			$table->string('website');
			$table->string('facebook');
			$table->string('twitter');
			
			$table->boolean('featured');
			$table->boolean('premium');

			$table->string('slug');
			$table->string('meta_description');
			$table->string('keywords');

			$table->softDeletes();
			$table->timestamps();
		});
	}

	public function down()
	{
		Schema::drop('organizers');
	}


}