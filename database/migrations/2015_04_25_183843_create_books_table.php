<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBooksTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('books', function(Blueprint $table)
		{
			$table->increments('id');
            $table->string('image');
            $table->string('title');
            $table->string('slug')->unique();
            $table->string('author');
            $table->string('isbn');
            $table->string('description', 1000);
            $table->decimal('price');
            $table->enum('status', ['available', 'sold'])->default('available');
            $table->integer('subject_id');
            $table->integer('user_id');
			$table->timestamps();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('books');
	}

}
