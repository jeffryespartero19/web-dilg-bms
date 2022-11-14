<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddMonthlyIncomeToBipsBrgyOfficialsAndStaffTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('bips_brgy_officials_and_staff', function (Blueprint $table) {
            $table->decimal('monthly_income',9,3);
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
            $table->dropColumn('monthly_income');
        });
    }
}
