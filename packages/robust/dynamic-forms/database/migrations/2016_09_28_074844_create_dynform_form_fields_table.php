<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Schema;

class CreateDynformFormFieldsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dynform_fields', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('form_id');
            $table->integer('page_no');
            $table->text('label')->nullable();
            $table->string('name', 100);
            $table->string('type', 50);
            $table->text('properties')->nullable();
            $table->text('conditions')->nullable();
            $table->tinyInteger('status')->default(1);
            $table->integer('required')->default(0);
            $table->integer('order')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('dynform_fields');
    }
}
