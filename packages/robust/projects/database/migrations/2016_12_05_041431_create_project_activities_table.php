<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProjectActivitiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('project_activities', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('project_id');
            $table->integer('output_id');
            $table->integer('parent_id')->nullable();
            $table->string('name');
            $table->longText('assumption')->nullable();
            $table->string('type', 50)->nullable();
            $table->integer('partner_id')->nullable();
            $table->date('start_date')->nullable();
            $table->date('end_date')->nullable();
            $table->string('numbering');
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
        Schema::drop('project_activities');
    }
}
