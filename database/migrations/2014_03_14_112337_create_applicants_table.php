<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateApplicantsTable extends Migration {

	public function up()
	{
		Schema::create('applicants', function($table) {
			$table->increments('id');
			$table->integer('user_id');

			$table->string('name')->nullable();
			$table->date('birthday')->nullable();
			$table->string('email')->nullable();
			$table->string('phone')->nullable();
			$table->string('photo')->nullable();
			
			$table->timestamps();
		});
	}

	public function down()
	{
		Schema::drop('applicants');
	}

}
