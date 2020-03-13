<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateCategorieSocioprosTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('categorie_sociopros', function(Blueprint $table)
		{
			$table->integer('code_categorie_sociopro_stat')->primary('pk_categorie_sociopro');
			$table->string('libelle_categorie_sosciopro')->nullable();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('categorie_sociopros');
	}

}
