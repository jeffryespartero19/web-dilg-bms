<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddVisibleToCmsIndicatorTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('bis_cms_indicator', function (Blueprint $table) {
            $table->boolean('visible')->nullable();
            $table->boolean('required')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('bis_cms_indicator', function (Blueprint $table) {
            $table->dropColumn('visible');
            $table->dropColumn('required');
        });
    }
}
