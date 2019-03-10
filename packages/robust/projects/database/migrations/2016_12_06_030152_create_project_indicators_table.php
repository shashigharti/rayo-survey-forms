<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProjectIndicatorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('project_indicators', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('indicatable_id');
            $table->string('indicatable_type', 150);
            $table->integer('parent_id')->nullable();
            $table->integer('project_id');
            $table->string('name');
            $table->string('type', 50)->nullable();
            $table->string('properties')->nullable();
            $table->string('baseline', 25)->nullable();
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
        Schema::drop('project_indicators');
    }
}
