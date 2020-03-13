<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToInscriptionPedagogiquesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('inscription_pedagogiques', function(Blueprint $table)
		{
			$table->foreign('code_academie', 'fk_inscript_inscripti_academie')->references('code_academie')->on('academies')->onUpdate('RESTRICT')->onDelete('RESTRICT');
			$table->foreign('id_etudiant', 'fk_inscript_inscripti_etudiant')->references('id_etudiant')->on('etudiants')->onUpdate('RESTRICT')->onDelete('RESTRICT');
			$table->foreign('code_province_opi', 'fk_inscript_inscripti_province')->references('code_province_opi')->on('provinces')->onUpdate('RESTRICT')->onDelete('RESTRICT');
			$table->foreign('code_serie_baccalaureat_opi', 'fk_inscript_inscripti_serie_ba')->references('code_serie_baccalaureat_opi')->on('serie_bacs')->onUpdate('RESTRICT')->onDelete('RESTRICT');
			$table->foreign('code_filiere', 'fk_inscript_inscripti_filiere')->references('code_filiere_stat')->on('filieres')->onUpdate('RESTRICT')->onDelete('RESTRICT');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('inscription_pedagogiques', function(Blueprint $table)
		{
			$table->dropForeign('fk_inscript_inscripti_academie');
			$table->dropForeign('fk_inscript_inscripti_etudiant');
			$table->dropForeign('fk_inscript_inscripti_province');
			$table->dropForeign('fk_inscript_inscripti_serie_ba');
			$table->dropForeign('fk_inscript_inscripti_filiere');
		});
	}

}
