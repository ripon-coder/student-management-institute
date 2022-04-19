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
        Schema::create('targeted_collection_monthwises', function (Blueprint $table) {
            $table->id();
            $table->string('title')->nullable();
            $table->decimal('requiredAmount',8,2)->nullable();
            $table->timestamp('targetmonth')->nullable();
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
        Schema::dropIfExists('targeted_collection_monthwises');
    }
};
