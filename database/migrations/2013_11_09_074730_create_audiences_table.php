<?php

use Illuminate\Database\Migrations\Migration;

class CreateAudiencesTable extends Migration {

	public function up()
	{
		Schema::create('audiences', function($table){
			$table->increments('id');
			$table->string('name');
		});
	}

	public function down()
	{
		Schema::drop('audiences');
	}
}