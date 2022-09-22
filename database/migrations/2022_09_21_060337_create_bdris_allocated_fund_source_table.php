<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBdrisAllocatedFundSourceTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('bdris_allocated_fund_source', function(Blueprint $table)
		{
			$table->integer('Allocated_Fund_ID')->primary();
			$table->string('Allocated_Fund_Name')->nullable();
			$table->float('Amount', 10)->nullable();
			$table->boolean('Active', 1)->nullable();
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
		Schema::drop('bdris_allocated_fund_source');
	}

}
