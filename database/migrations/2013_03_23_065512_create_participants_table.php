<?php

use Illuminate\Database\Migrations\Migration;

class CreateParticipantsTable extends Migration {

	public function up()
	{
		Schema::create('participants', function($table) {
			$table->increments('id');
			$table->integer('event_id');
			$table->integer('company_id');
			$table->boolean('interview')->nullable();
			$table->string('comment');
			$table->timestamps();
		});
	}

	public function down()
	{
		Schema::drop('participants');
	}

}