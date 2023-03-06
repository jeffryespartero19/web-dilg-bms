<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateInvDisposal extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('bins_inventory_for_disposal', function (Blueprint $table) {
            $table->integer('Quantity_Disposed')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('bins_inventory_for_disposal', function (Blueprint $table) {
            $table->dropColumn('Quantity_Disposed');
        });
    }
}
