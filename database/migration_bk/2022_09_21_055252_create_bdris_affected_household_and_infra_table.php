<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBdrisAffectedHouseholdAndInfraTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('bdris_affected_household_and_infra', function(Blueprint $table)
		{
			$table->integer('Affected_Household_ID')->primary();
			$table->integer('Disaster_Recovery_ID');
			$table->integer('Household_Profile_ID');
			$table->integer('Level_of_Damage_ID');
			$table->string('Affected_Infrastructure_Name', 100)->nullable();
			$table->string('Address', 100)->nullable();
			$table->float('Estimated_Damage_Value', 10)->nullable();
			$table->string('Remarks')->nullable();
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
		Schema::drop('bdris_affected_household_and_infra');
	}

}
