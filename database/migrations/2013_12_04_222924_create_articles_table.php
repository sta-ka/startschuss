<?php

use Illuminate\Database\Migrations\Migration;

class CreateArticlesTable extends Migration {

	public function up()
	{
		Schema::create('articles', function($table)
		{
			$table->increments('id');
			$table->string('title');
			$table->string('slug');
			$table->string('image');
			$table->text('body');

			$table->boolean('active');
			$table->boolean('featured');

			$table->string('meta_description');
			$table->string('keywords');
			
			$table->timestamps();
		});
	}

	public function down()
	{
		Schema::drop('articles');
	}

}
