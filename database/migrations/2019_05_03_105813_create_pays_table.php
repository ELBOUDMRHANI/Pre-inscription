<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreatePaysTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('pays', function(Blueprint $table)
		{
			$table->integer('id_pays')->primary('pk_pays');
			$table->integer('code_pays_stat')->nullable();
			$table->string('libelle_pays_fr')->nullable();
			$table->integer('code_sis_pays_cnops')->nullable();
			$table->integer('code_pays_cnops')->nullable();
			$table->string('libelle_nationalite')->nullable();
			$table->string('abreviation_pays_car_2')->nullable();
			$table->string('abreviation_pays_car_3')->nullable();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('pays');
	}

}
