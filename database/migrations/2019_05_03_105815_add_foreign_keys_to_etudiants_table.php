<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToEtudiantsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('etudiants', function(Blueprint $table)
		{
			$table->foreign('compte_id')->references('id')->on('comptes')->onUpdate('RESTRICT')->onDelete('RESTRICT');
			$table->foreign('code_assurance', 'fk_etudiant_relations_assuranc')->references('code_assurance')->on('assurances')->onUpdate('RESTRICT')->onDelete('RESTRICT');
			$table->foreign('code_categorie_sociopro_stat', 'fk_etudiant_relations_categori')->references('code_categorie_sociopro_stat')->on('categorie_sociopros')->onUpdate('RESTRICT')->onDelete('RESTRICT');
			$table->foreign('id_commune', 'fk_etudiant_relations_commune')->references('id_commune_stat')->on('communes')->onUpdate('RESTRICT')->onDelete('RESTRICT');
			$table->foreign('id_handicap_stat', 'fk_etudiant_relations_handicap')->references('id_handicap_stat')->on('handicaps')->onUpdate('RESTRICT')->onDelete('RESTRICT');
			$table->foreign('id_pays', 'fk_etudiant_relations_pays')->references('id_pays')->on('pays')->onUpdate('RESTRICT')->onDelete('RESTRICT');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('etudiants', function(Blueprint $table)
		{
			$table->dropForeign('etudiants_compte_id_foreign');
			$table->dropForeign('fk_etudiant_relations_assuranc');
			$table->dropForeign('fk_etudiant_relations_categori');
			$table->dropForeign('fk_etudiant_relations_commune');
			$table->dropForeign('fk_etudiant_relations_handicap');
			$table->dropForeign('fk_etudiant_relations_pays');
		});
	}

}
