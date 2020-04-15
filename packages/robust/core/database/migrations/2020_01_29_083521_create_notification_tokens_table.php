<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateNotificationTokensTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('notification_tokens', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('user_id');
			$table->string('email');
			$table->string('token');
			$table->timestamps();
			$table->string('app');
			$table->integer('active');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('notification_tokens');
	}

}
