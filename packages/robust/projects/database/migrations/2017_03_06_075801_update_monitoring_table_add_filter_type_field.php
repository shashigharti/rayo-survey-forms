<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateMonitoringTableAddFilterTypeField extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('project_monitorings', function (Blueprint $table) {
            $table->string('filter_type')->after('end_date');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('project_monitorings', function (Blueprint $table) {
            $table->dropColumn('filter_type');
        });
    }
}
