<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterTableDynamicFormFieldsAddContainer extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('dynform_fields', function ($table) {
            $table->integer('section_id')->after('form_id')->default(0);
            $table->integer('column_no')->after('order')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('dynform_fields', function ($table) {
            $table->dropColumn('section_id');
            $table->dropColumn('column_no');
        });
    }
}
