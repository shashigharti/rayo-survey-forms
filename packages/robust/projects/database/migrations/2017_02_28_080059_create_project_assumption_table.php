<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProjectAssumptionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('project_assumptions', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('assumable_id');
            $table->integer('parent_id');
            $table->string('assumable_type', 150);
            $table->integer('project_id');
            $table->string('assumption');
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
        Schema::dropIfExists('project_assumptions');
    }
}
