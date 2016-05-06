<?php

use Illuminate\Database\Migrations\Migration;

class CreateEventsTable extends Migration {

	public function up()
	{
		Schema::create('events', function($table) {
			$table->increments('id');
			$table->integer('user_id');
			
			$table->string('name');
			$table->string('location');
			$table->date('start_date');
			$table->date('end_date');

			$table->string('opening_hours1');
			$table->string('opening_hours2');
			$table->string('logo');
			$table->string('specific_location1');
			$table->string('specific_location2');
			$table->string('specific_location3');
			$table->string('audience');
			$table->string('admission');
			$table->text('profile');
			$table->text('program');
			$table->string('website');
			$table->string('facebook');
			$table->string('twitter');
			$table->integer('organizer_id');
			$table->integer('region_id');

			$table->string('application_deadline');
			$table->boolean('applications_closed');

			$table->boolean('interviews');
			$table->boolean('interviews_locked');

			$table->boolean('visible');
			$table->boolean('premium');

			$table->integer('requested_by')->nullable();

			$table->string('slug');
			$table->string('meta_description');
			$table->string('keywords');

			$table->softDeletes();
			$table->timestamps();
		});
	}

	public function down()
	{
		Schema::drop('events');
	}

}