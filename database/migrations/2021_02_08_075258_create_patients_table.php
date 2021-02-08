<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePatientsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('patients', function (Blueprint $table) {
            $table->id();
            $table->string('firstName')->nullable();
            $table->string('lastName')->nullable();
            $table->date('dateOfBirth')->nullable();
            $table->bigInteger('genderId')->unsigned()->index()->nullable();//added nullable due to deleting of genders
            $table->foreign('genderId')->references('id')->on('genders');
            $table->bigInteger('serviceId')->unsigned()->index()->nullable(); //added nullable due to deleting of services
            $table->foreign('serviceId')->references('id')->on('services');
            $table->text('comments')->nullable();
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
        Schema::dropIfExists('patients');
    }
}
