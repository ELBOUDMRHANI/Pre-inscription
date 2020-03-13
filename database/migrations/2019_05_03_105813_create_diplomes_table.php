<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateDiplomesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('diplomes', function(Blueprint $table)
		{
			$table->string('libelle_diplome_fr')->nullable();
			$table->string('libelle_diplome_ar')->nullable();
			$table->boolean('ouvert_aux_inscription')->nullable();
			$table->string('abreviation')->nullable();
			$table->string('code_diplome')->primary('pk_diplome');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('diplomes');
	}

}
