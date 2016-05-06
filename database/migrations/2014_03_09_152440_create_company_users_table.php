<?php

use Illuminate\Database\Migrations\Migration;

class CreateCompanyUsersTable extends Migration {

	public function up()
	{
		Schema::create('company_users', function($table) {
			$table->integer('company_id');
			$table->integer('user_id')->unique();
		});
	}

	public function down()
	{
		Schema::drop('company_users');
	}


}