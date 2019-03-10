<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProjectTargetsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('project_targets', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('project_id');
            $table->string('name');
            $table->string('type', 50);
            $table->integer('number_of_beneficiaries');
            $table->integer('total_number');
            $table->integer('number_of_male');
            $table->integer('number_of_female');
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
        Schema::drop('project_targets');
    }
}
