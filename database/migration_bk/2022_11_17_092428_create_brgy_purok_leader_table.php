<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBrgyPurokLeaderTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bips_brgy_purok_leader', function (Blueprint $table) {
            $table->id('Brgy_Purok_Leader_ID');
            $table->string('Term_from', 10);
            $table->string('Term_to', 10);
            $table->boolean('Active');
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
        Schema::dropIfExists('bips_brgy_purok_leader');
    }
}
