<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddFieldsToBipsBrgyOfficialsAndStaffTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('bips_brgy_officials_and_staff', function (Blueprint $table) {
            $table->string('Term_from', 10);
            $table->string('Term_to', 10);
            $table->boolean('Active');
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
        Schema::table('bips_brgy_officials_and_staff', function (Blueprint $table) {
            $table->dropColumn('Term_from');
            $table->dropColumn('Term_to');
            $table->dropColumn('Active');
            $table->dropColumn('Barangay_ID');
        });
    }
}
