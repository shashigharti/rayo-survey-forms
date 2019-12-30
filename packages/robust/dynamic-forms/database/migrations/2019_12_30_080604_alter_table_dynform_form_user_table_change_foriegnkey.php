<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterTableDynformFormUserTableChangeForiegnkey extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('dynform_form_user', function(Blueprint $table)
        {
            $table->dropForeign('dynform_form_user_form_id_foreign');
            $table->dropForeign('dynform_form_user_user_id_foreign');
        });
    }
    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('dynform_form_user', function(Blueprint $table)
        {
            $table->foreign('form_id')->references('id')->on('dynform_forms');
            $table->foreign('user_id')->references('id')->on('users');
        });
    }
}
