<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBorisPrOrdinanceTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('boris_pr_ordinance', function (Blueprint $table) {
            $table->id();
            $table->integer('Ordinance_Resolution_ID');
            $table->integer('Previous_Related_Ordinance_Resolution_ID');
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
        Schema::dropIfExists('boris_pr_ordinance');
    }
}
