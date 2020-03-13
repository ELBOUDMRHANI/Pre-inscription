<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateEtudiantsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('etudiants', function(Blueprint $table)
		{
			$table->integer('id_etudiant', true);
			$table->integer('id_pays')->nullable();
			$table->integer('code_categorie_sociopro_stat')->nullable();
			$table->integer('id_handicap_stat')->nullable();
			$table->string('code_assurance')->nullable();
			$table->string('cni_etudiant')->nullable();
			$table->string('nom_etudiant_fr')->nullable();
			$table->string('prenom_etudiant_fr')->nullable();
			$table->string('nom_etudiant_ar')->nullable();
			$table->string('prenom_etudiant_ar')->nullable();
			$table->string('date_naissance_etud')->nullable();
			$table->string('etat_civile_etudiant')->nullable();
			$table->string('sexe_etudiant')->nullable();
			$table->string('nationalite_etudiant')->nullable();
			$table->string('adresse_personnelle_etud')->nullable();
			$table->string('ville_naissance_etud')->nullable();
			$table->string('tel_fixe_etudiant')->nullable();
			$table->string('tel_mobile_etudiant')->nullable();
			$table->string('email_etudiant')->nullable();
			$table->string('password')->nullable();
			$table->integer('code_categorie_sociopro_etud')->nullable();
			$table->integer('code_categorie_sociopro_pere')->nullable();
			$table->integer('code_categorie_sociopro_mere')->nullable();
			$table->string('photo_etudiant')->nullable();
			$table->boolean('profession_statut')->nullable();
			$table->string('ville_adresse_etudiant')->nullable();
			$table->boolean('handicap_statut')->nullable();
			$table->string('adresse_mail_academique')->nullable();
			$table->string('nom_prenom_etud_fr')->nullable();
			$table->string('nom_prenom_etud_ar')->nullable();
			$table->string('code_massar')->nullable();
			$table->string('ville_naissance_etud_ar')->nullable();
			$table->string('civilite_etudiant')->nullable();
			$table->string('id_commune')->nullable()->index('fki_fk_etudiant_relations_commune');
			$table->bigInteger('compte_id')->nullable();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('etudiants');
	}

}
