<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMaintenanceBipsBrgyPositionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('maintenance_bips_brgy_position', function (Blueprint $table) {
            $table->id('Brgy_Position_ID');
            $table->string('Brgy_Position');
            $table->boolean('Active');
            $table->integer('Encoder_ID');
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
        Schema::dropIfExists('maintenance_bips_brgy_position');
    }
}
