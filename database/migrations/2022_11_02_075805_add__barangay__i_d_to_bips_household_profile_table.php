<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddBarangayIDToBipsHouseholdProfileTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('bips_household_profile', function (Blueprint $table) {
            $table->integer('Barangay_ID');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('bips_household_profile', function (Blueprint $table) {
            $table->dropColumn('Barangay_ID');
        });
    }
}
