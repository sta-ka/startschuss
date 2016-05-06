<?php

use Illuminate\Database\Migrations\Migration;

class CreateLoginsTable extends Migration {

	public function up()
	{
		Schema::create('logins', function($table){
			$table->increments('id');
			
			$table->string('username');
			$table->integer('user_id')->nullable();
			$table->string('ip_address');
			$table->integer('success');
			$table->string('comment')->nullable();

			$table->timestamps();
		});
	}

	public function down()
	{
		Schema::drop('logins');
	}

}