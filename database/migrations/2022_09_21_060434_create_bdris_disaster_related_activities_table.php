<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBdrisDisasterRelatedActivitiesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('bdris_disaster_related_activities', function(Blueprint $table)
		{
			$table->integer('Disaster_Related_Activities_ID')->primary();
			$table->string('Activity_Name', 100)->nullable();
			$table->string('Purpose', 100)->nullable();
			$table->date('Date_Start')->nullable();
			$table->date('Date_End')->nullable();
			$table->integer('Number_of_Participants')->nullable();
			$table->integer('Brgy_Officials_and_Staff_ID');
			$table->string('Barangay_ID', 3);
			$table->string('City_Municipality_ID', 2);
			$table->string('Province_ID', 3);
			$table->string('Region_ID', 2);
			$table->integer('Encoder_ID');
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
		Schema::drop('bdris_disaster_related_activities');
	}

}
