<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateProjectIndicatorTableAddIndicatorTypeNameField extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('project_indicators', function (Blueprint $table) {
            $table->string('indicatable_type_name')->after('indicatable_type')->nullable();
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
            $table->dropColumn('indicatable_type_name');
        });
    }
}
