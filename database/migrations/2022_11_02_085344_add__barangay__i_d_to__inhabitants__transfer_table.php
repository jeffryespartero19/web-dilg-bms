<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddBarangayIDToInhabitantsTransferTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('Inhabitants_Transfer', function (Blueprint $table) {
            $table->integer('Main_Barangay_ID');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('Inhabitants_Transfer', function (Blueprint $table) {
            $table->dropColumn('Main_Barangay_ID');
        });
    }
}
