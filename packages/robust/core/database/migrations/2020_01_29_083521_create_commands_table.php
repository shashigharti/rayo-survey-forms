<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateCommandsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('commands', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('name')->unique();
			$table->timestamps();
			$table->softDeletes();
			$table->string('description', 100)->nullable();
			$table->string('command', 100);
			$table->boolean('status')->nullable()->default(0);
			$table->dateTime('executed_at')->nullable();
			$table->dateTime('next_execution_at')->nullable();
			$table->dateTime('last_execution_status')->nullable();
			$table->text('frequency', 65535)->nullable();
			$table->string('at', 50)->nullable();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('commands');
	}

}
