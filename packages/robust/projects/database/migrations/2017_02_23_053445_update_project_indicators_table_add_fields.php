<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateProjectIndicatorsTableAddFields extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('project_indicators', function (Blueprint $table) {
            $table->string('registration')->after('baseline');
            $table->string('target_id')->after('registration');
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
            $table->dropColumn('registration');
            $table->dropColumn('target_id');

        });
    }
}
