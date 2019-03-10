<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateProjectIndicatorTableUpdateDataTypeOfName extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('project_indicators', function (Blueprint $table) {
            $table->longText('name')->change();
        });

        Schema::table('project_goals', function (Blueprint $table) {
            $table->longText('name')->change();
        });

        Schema::table('project_assumptions', function (Blueprint $table) {
            $table->longText('assumption')->change();
        });

        Schema::table('project_activities', function (Blueprint $table) {
            $table->longText('name')->change();
        });

        Schema::table('project_monitorings', function (Blueprint $table) {
            $table->longText('name')->change();
        });

        Schema::table('project_outcomes', function (Blueprint $table) {
            $table->longText('name')->change();
        });

        Schema::table('project_outputs', function (Blueprint $table) {
            $table->longText('name')->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {

        Schema::table('project_indicators', function (Blueprint $table) {
            $table->string('name')->change();

        });

        Schema::table('project_goals', function (Blueprint $table) {
            $table->string('name')->change();

        });

        Schema::table('project_assumptions', function (Blueprint $table) {
            $table->string('assumption')->change();

        });

        Schema::table('project_activities', function (Blueprint $table) {
            $table->string('name')->change();

        });

        Schema::table('project_monitorings', function (Blueprint $table) {
            $table->string('name')->change();
        });

        Schema::table('project_outcomes', function (Blueprint $table) {
            $table->string('name')->change();

        });

        Schema::table('project_outputs', function (Blueprint $table) {
            $table->string('name')->change();

        });
    }
}
