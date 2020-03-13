<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateInscriptionPedagogiquesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('inscription_pedagogiques', function(Blueprint $table)
		{
			$table->integer('id_etudiant');
			$table->integer('code_serie_baccalaureat_opi');
			$table->integer('code_province_opi');
			$table->string('code_academie');
			$table->string('code_filiere', 1024)->index('fki_fk_inscript_inscripti_filiere');
			$table->date('annee_bac')->nullable();
			$table->date('annee_inscription')->nullable();
			$table->string('mention_baccalaureat')->nullable();
			$table->string('annee_baccalaureat')->nullable();
			$table->float('moyenne_baccalaureat', 10, 0)->nullable();
			$table->string('lycee_obtention_baccalaureat')->nullable();
			$table->string('inscription_valide_par_user')->nullable();
			$table->dateTime('date_validation_inscription')->nullable();
			$table->boolean('validation')->nullable();
			$table->primary(['id_etudiant','code_serie_baccalaureat_opi','code_province_opi','code_academie','code_filiere'], 'pk_inscription_pedagogique');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('inscription_pedagogiques');
	}

}
