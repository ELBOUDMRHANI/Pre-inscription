<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToDossierAmosTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('dossier_amos', function(Blueprint $table)
		{
			$table->foreign('id_code_postal', 'fk_dossier__relations_code_pos')->references('id_code_postal')->on('code_postales')->onUpdate('RESTRICT')->onDelete('RESTRICT');
			$table->foreign('id_etudiant', 'fk_dossier__relations_etudiant')->references('id_etudiant')->on('etudiants')->onUpdate('RESTRICT')->onDelete('RESTRICT');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('dossier_amos', function(Blueprint $table)
		{
			$table->dropForeign('fk_dossier__relations_code_pos');
			$table->dropForeign('fk_dossier__relations_etudiant');
		});
	}

}
