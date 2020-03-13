<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateEtablissementsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('etablissements', function(Blueprint $table)
		{
			$table->integer('code_etablissement_stat')->primary('pk_etablissement');
			$table->integer('code_universite')->nullable();
			$table->string('libelle_etablissement_fr')->nullable();
			$table->string('libelle_etablissement_ar')->nullable();
			$table->string('abreviation_atablissement')->nullable();
			$table->string('logo_etablissement')->nullable();
			$table->string('pied_de_page_etablissement')->nullable();
			$table->boolean('acces_ouvert')->nullable();
			$table->integer('code_etablissement_cnops')->nullable();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('etablissements');
	}

}
