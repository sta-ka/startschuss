<?php

use Illuminate\Database\Migrations\Migration;

class CreateSessionTable extends Migration {

	public function up()
	{
		Schema::create('sessions', function($t)
		{
			$t->string('id')->unique();
			$t->text('payload');
			$t->integer('last_activity');
		});
	}

	public function down()
	{
		Schema::drop('sessions');
	}

}
