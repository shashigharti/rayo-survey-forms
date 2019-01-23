<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateDynformFormsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('dynform_forms', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('title', 100)->unique();
			$table->string('slug', 100);
			$table->text('properties', 65535)->nullable();
			$table->string('display', 15)->nullable();
			$table->string('field_for_user_email')->nullable();
			$table->boolean('notify_to_user')->nullable();
			$table->integer('single_submit')->default(0);
			$table->integer('make_public')->default(0);
			$table->boolean('status')->default(1);
			$table->timestamps();
			$table->softDeletes();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('dynform_forms');
	}

}
