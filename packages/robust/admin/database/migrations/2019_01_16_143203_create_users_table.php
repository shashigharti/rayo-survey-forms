<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateUsersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('users', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('first_name')->nullable();
			$table->string('last_name')->nullable();
			$table->string('user_name')->nullable();
			$table->string('email')->unique();
			$table->string('password')->nullable();
			$table->string('organization')->nullable();
			$table->string('department')->nullable();
			$table->string('avatar')->nullable();
			$table->string('remember_token', 100)->nullable();
			$table->timestamps();
			$table->timestamp('email_verified_at')->nullable();
			$table->string('contact')->nullable();
			$table->string('address')->nullable();
			$table->string('gender')->nullable();
			$table->string('region')->nullable();
			$table->string('tole')->nullable();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('users');
	}

}
