<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateDashboardsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('dashboards', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('user_id');
			$table->string('name');
			$table->string('slug');
			$table->text('description', 65535);
			$table->boolean('is_default')->default(0);
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
		Schema::drop('dashboards');
	}

}
