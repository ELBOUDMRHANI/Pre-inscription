<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateCodePostalesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('code_postales', function(Blueprint $table)
		{
			$table->integer('id_code_postal')->primary('pk_code_postale');
			$table->string('libelle_secteur');
			$table->integer('code_region')->nullable();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('code_postales');
	}

}
