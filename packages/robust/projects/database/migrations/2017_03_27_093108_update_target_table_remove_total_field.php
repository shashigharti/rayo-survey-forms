<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateTargetTableRemoveTotalField extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('project_targets', function (Blueprint $table) {
            $table->dropColumn('total_number');
            $table->dropColumn('number_of_male');
            $table->dropColumn('number_of_female');
            $table->longText('micro_beneficiaries');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('project_targets', function (Blueprint $table) {
            $table->integer('total_number');
            $table->integer('number_of_male');
            $table->integer('number_of_female');
            $table->dropColumn('micro_beneficiaries');
        });
    }
}
