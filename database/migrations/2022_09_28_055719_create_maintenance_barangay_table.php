<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMaintenanceBarangayTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('maintenance_barangay', function(Blueprint $table)
		{
			$table->integer('Barangay_ID', true);
			$table->string('Region_ID', 10);
			$table->string('Province_ID', 10);
			$table->string('City_Municipality_ID', 10);
			$table->string('PSGC_code', 3);
			$table->string('Barangay_Name');
			$table->boolean('Active', 1);
			$table->integer('Encoder_ID')->unsigned();
			$table->dateTime('Date_Stamp')->nullable();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('maintenance_barangay');
	}

}
