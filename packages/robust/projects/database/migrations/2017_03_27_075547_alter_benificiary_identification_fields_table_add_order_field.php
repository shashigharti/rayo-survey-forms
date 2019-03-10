<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterBenificiaryIdentificationFieldsTableAddOrderField extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('project_benificiary_identification_fields', function (Blueprint $table) {
            $table->integer('order')->after('type');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('project_benificiary_identification_fields', function (Blueprint $table) {
            $table->dropColumn('order');
        });
    }
}
