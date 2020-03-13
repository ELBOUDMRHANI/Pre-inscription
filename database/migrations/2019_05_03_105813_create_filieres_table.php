<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateFilieresTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('filieres', function(Blueprint $table)
		{
			$table->string('code_filiere_stat', 1024)->primary('pk_filiere');
			$table->integer('code_etablissement');
			$table->string('libelle_filiere')->nullable();
			$table->string('delai_inscription')->nullable();
			$table->string('abreviation_filiere')->nullable();
			$table->string('code_ldap_filiere')->nullable();
			$table->integer('valeur_numero_dossier')->nullable();
			$table->string('code_diplome')->nullable();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('filieres');
	}

}
