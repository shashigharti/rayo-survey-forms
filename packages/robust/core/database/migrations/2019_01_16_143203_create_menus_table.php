<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateMenusTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('menus', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('display_name');
			$table->string('name');
			$table->string('package_name');
			$table->text('permission', 65535);
			$table->string('url');
			$table->string('type');
			$table->integer('order')->nullable();
			$table->string('icon')->nullable();
			$table->text('parent_id', 65535);
			$table->string('remember_token', 100)->nullable();
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
		Schema::drop('menus');
	}

}
