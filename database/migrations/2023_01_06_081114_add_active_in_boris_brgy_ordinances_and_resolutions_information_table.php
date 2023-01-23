<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddActiveInBorisBrgyOrdinancesAndResolutionsInformationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('boris_brgy_ordinances_and_resolutions_information', function (Blueprint $table) {
            $table->boolean('active')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('boris_brgy_ordinances_and_resolutions_information', function (Blueprint $table) {
            //
        });
    }
}
