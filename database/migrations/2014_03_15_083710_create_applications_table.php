<?php

use Illuminate\Database\Migrations\Migration;

class CreateApplicationsTable extends Migration {

	public function up()
	{
		Schema::create('applications', function($table) {
			$table->increments('id');

			$table->integer('applicant_id');
			$table->integer('event_id');
			$table->integer('company_id');
			
			$table->text('cover_letter');
			$table->text('comment');

			$table->boolean('approved_by_organizer')->nullable();
			$table->boolean('rejected_by_organizer')->nullable();

			$table->boolean('accepted_by_company')->nullable();
			$table->boolean('rejected_by_company')->nullable();
			$table->text('comment_to_application')->nullable();

			$table->timestamp('time_of_interview')->nullable();
			$table->text('place_of_interview')->nullable();

			$table->softDeletes();
			$table->timestamps();
		});
	}

	public function down()
	{
		Schema::drop('applications');
	}

}
