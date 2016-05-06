<?php

use Illuminate\Database\Migrations\Migration;

class CreateRegionsTable extends Migration {

	public function up()
	{
		Schema::create('regions', function($table){
			$table->increments('id');
			$table->string('name');
            $table->string('slug');
            $table->string('prefix');
            $table->text('description');
			
			$table->text('meta_description');
			$table->text('keywords');
		});
	}

	public function down()
	{
		Schema::drop('regions');
	}

}
