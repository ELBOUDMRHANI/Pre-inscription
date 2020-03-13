<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateOpiEtabsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('opi_etabs', function(Blueprint $table)
		{
			$table->integer('id_etudiant_opi_etab', true);
			$table->string('code_filiere');
			$table->string('annee_import');
			$table->string('nom_prenom_etud_fr')->nullable();
			$table->string('nom_prenom_etud_ar')->nullable();
			$table->string('cni_etudiant')->nullable();
			$table->string('date_naissance_etud')->nullable();
			$table->string('sexe_etudiant')->nullable();
			$table->string('annee_baccalaureat')->nullable();
			$table->string('moyene_baccalaureat')->nullable();
			$table->integer('province')->nullable();
			$table->string('code_academie')->nullable();
			$table->integer('code_serie_baccalaureat')->nullable();
			$table->string('code_massar')->nullable();
			$table->string('lieu_naissance_etud_fr')->nullable();
			$table->string('lieu_naissance_etud_ar')->nullable();
			$table->string('prenom_etud_fr')->nullable();
			$table->string('nom_etud_fr')->nullable();
			$table->string('nom_etud_ar')->nullable();
			$table->string('prenom_etud_ar')->nullable();
			$table->string('added_by_user')->nullable();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('opi_etabs');
	}

}
