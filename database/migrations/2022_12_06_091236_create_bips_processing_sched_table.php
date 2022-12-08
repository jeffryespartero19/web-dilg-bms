<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBipsProcessingSchedTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bips_processing_sched', function (Blueprint $table) {
            $table->id();
            $table->integer('days');
            $table->integer('Encoder_ID');
            $table->integer('Barangay_ID');
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
        Schema::dropIfExists('bips_processing_sched');
    }
}
