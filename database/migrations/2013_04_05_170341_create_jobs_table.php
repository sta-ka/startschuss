<?php

use Illuminate\Database\Migrations\Migration;

class CreateJobsTable extends Migration {

	public function up()
	{
		Schema::create('jobs', function($table) {
			$table->increments('id');
			$table->integer('company_id');

			$table->string('title');
			$table->string('slug');
			$table->string('location');
			$table->string('start_date');
			$table->text('type');
			$table->text('description');
			$table->text('requirements');

			$table->boolean('active');
			$table->boolean('approved');
			$table->boolean('expired');
			$table->text('created_by');

			$table->boolean('featured');
			$table->boolean('premium');

			$table->text('meta_description');
			$table->text('keywords');

			$table->timestamp('published_at');
			$table->timestamp('expire_at');
			$table->softDeletes();
			$table->timestamps();
		});
	}

	public function down()
	{
		Schema::drop('jobs');
	}

}