<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateDossierAmosTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('dossier_amos', function(Blueprint $table)
		{
			$table->integer('id_amo', true);
			$table->integer('id_code_postal')->nullable();
			$table->integer('id_etudiant')->nullable();
			$table->string('adresse_parents_etud')->nullable();
			$table->string('ville_parents')->nullable();
			$table->string('nom_pere_etudiant')->nullable();
			$table->string('prenom_pere_etudiant')->nullable();
			$table->string('cni_pere_etudiant')->nullable();
			$table->string('nom_mere_etudiant')->nullable();
			$table->string('prenom_mere_etudiant')->nullable();
			$table->string('cni_mere_etudiant')->nullable();
			$table->boolean('rib_etudiant_statut')->nullable();
			$table->string('numero_rib_etudiant')->nullable();
			$table->boolean('cni_pere_etudiant_statut')->nullable();
			$table->boolean('cni_mere_etudiant_statut')->nullable();
			$table->string('date_naissance_pere_etud')->nullable();
			$table->string('date_naissance_mere_etud')->nullable();
			$table->boolean('dece_pere_etud_statut')->nullable();
			$table->boolean('dece_mere_etud_statut')->nullable();
			$table->string('date_dece_pere_etud')->nullable();
			$table->string('date_dece_mere_etud')->nullable();
			$table->boolean('couverture_medicale_statut')->nullable();
			$table->string('cni_conjoint_etudiant')->nullable();
			$table->string('date_divorce_etudiant')->nullable();
			$table->string('date_dece_conjoint_etud')->nullable();
			$table->string('code_postal')->nullable();
			$table->string('date_inscription_etud')->nullable();
			$table->string('heure_inscription_etud')->nullable();
			$table->string('numero_dossier_inscription')->nullable();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('dossier_amos');
	}

}
