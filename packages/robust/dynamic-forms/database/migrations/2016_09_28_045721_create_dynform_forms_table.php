<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Schema;

class CreateDynformFormsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dynform_forms', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title', 100)->unique();
            $table->string('slug', 100);
            $table->integer('pages')->default(1);
            $table->string('field_for_user_email')->nullable();
            $table->boolean('notify_to_user')->nullable();
            $table->integer('single_submit')->default(0);
            $table->integer('form_group_id')->nullable();
            $table->tinyInteger('status')->default(1);
            $table->boolean('notify_to_admin')->default(false);
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
        Schema::dropIfExists('dynform_forms');
    }
}
