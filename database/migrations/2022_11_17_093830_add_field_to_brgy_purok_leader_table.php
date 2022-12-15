<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddFieldToBrgyPurokLeaderTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('bips_brgy_purok_leader', function (Blueprint $table) {
            $table->integer('Resident_ID');
            $table->integer('Encoder_ID');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('bips_brgy_purok_leader', function (Blueprint $table) {
            $table->dropColumn('Resident_ID');
            $table->dropColumn('Encoder_ID');
        });
    }
}
