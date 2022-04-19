<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('batch_models', function (Blueprint $table) {
            $table->id();
            $table->string('batchno');
            $table->unsignedBigInteger('course_id')->nullable();
            $table->string('classOnWeek')->nullable();
            $table->string('duration')->nullable();
            $table->string('startdate')->nullable();
            $table->string('enddate')->nullable();
            $table->string('classtime')->nullable();
            $table->string('expectedStudent')->nullable();
            $table->unsignedBigInteger('mentor_id')->nullable();
            $table->string('mentor_name')->nullable();
            $table->string('status')->nullable();
            $table->text('classOnDay')->nullable();
            $table->timestamps();

            $table->foreign('course_id')->references('id')->on('course_models')->onDelete('cascade');
            $table->foreign('mentor_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('batch_models');
    }
};
