<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddFieldToBjisbhProceedingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('bjisbh_proceedings', function (Blueprint $table) {
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
        Schema::table('bjisbh_proceedings', function (Blueprint $table) {
            $table->dropColumn('Barangay_ID');
        });
    }
}
