<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterDynformTableAddMakePublicField extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('dynform_forms', function (Blueprint $table) {
            $table->integer('make_public')->after('single_submit')->default(0);

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('dynform_forms', function (Blueprint $table) {
            $table->dropColumn('make_public');
        });
    }
}
