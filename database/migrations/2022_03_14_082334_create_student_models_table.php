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
        Schema::create('student_models', function (Blueprint $table) {
            $table->id();
            $table->string('token')->nullable();
            $table->string('name');
            $table->string('fathername');
            $table->string('mothername');
            $table->unsignedBigInteger('course_id')->nullable();
            $table->text('address')->nullable();
            $table->string('mobile');
            $table->unsignedBigInteger('batch_id')->nullable();
            $table->string('fbname')->nullable();
            $table->string('dateofbirth');
            $table->string('gender');
            $table->unsignedBigInteger('reference_id')->nullable();
            $table->string('education')->nullable();
            $table->string('hwpay')->nullable();

            $table->decimal('totalAmount',8,2)->nullable();
            $table->decimal('payAmount',8,2)->nullable();

            $table->string('status')->nullable();

            $table->foreign('course_id')->references('id')->on('course_models')->onDelete('cascade');
            $table->foreign('batch_id')->references('id')->on('batch_models')->onDelete('cascade');
            $table->foreign('reference_id')->references('id')->on('users')->onDelete('cascade');

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
        Schema::dropIfExists('student_models');
    }
};
