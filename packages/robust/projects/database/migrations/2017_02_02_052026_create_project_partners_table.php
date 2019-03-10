<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProjectPartnersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('project_partners', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('project_id');
            $table->string('name');
            $table->string('acronym')->nullable();
            $table->string('organization_type');
            $table->longText('description');
            $table->string('type', 50);
            $table->string('contact_person', 50);
            $table->string('contact_number', 50);
            $table->string('contact_email', 80);
            $table->string('contact_address');
            $table->string('designation')->nullable();
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
        Schema::drop('project_partners');
    }
}
