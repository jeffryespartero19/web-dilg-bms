<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateJusticeRatingTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('justice_rating', function (Blueprint $table) {
            $table->id();
            $table->integer('Blotter_ID');
            $table->integer('speed')->nullable();
            $table->integer('outcome')->nullable();
            $table->integer('quality')->nullable();
            $table->integer('Resident_ID')->nullable();
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
        Schema::dropIfExists('justice_rating');
    }
}
