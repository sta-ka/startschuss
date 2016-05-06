<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEducationTable extends Migration {

	public function up()
	{
		Schema::create('education', function($table){
			$table->increments('id');
			$table->integer('applicant_id');
			
			$table->string('university');
			$table->string('branch_of_study');
			$table->string('key_aspects');

			$table->timestamp('start_date');
			$table->timestamp('end_date');
			$table->integer('to_date');
			$table->integer('month_start');
			$table->integer('year_start');
			$table->integer('month_end');
			$table->integer('year_end');

			$table->timestamps();
		});
	}

	public function down()
	{
		Schema::drop('education');
	}

}
