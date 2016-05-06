<?php

use Illuminate\Database\Migrations\Migration;

class CreateLogsTable extends Migration {

	public function up()
	{
		Schema::create('logs', function($table){
			$table->increments('id');
			
			$table->string('ip_address');
			$table->text('message');

			$table->timestamps();
		});
	}

	public function down()
	{
		Schema::drop('logs');
	}

}
