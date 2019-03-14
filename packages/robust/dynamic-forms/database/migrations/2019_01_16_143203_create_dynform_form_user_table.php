<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateDynformFormUserTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('dynform_form_user', function(Blueprint $table)
		{
			$table->unsignedInteger('form_id');
			$table->unsignedInteger('user_id');
			$table->foreign('form_id')->references('id')->on('dynform_forms');
			$table->foreign('user_id')->references('id')->on('users');
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
		Schema::drop('dynform_form_user');
	}
}
