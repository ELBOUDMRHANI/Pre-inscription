<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToFilieresTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('filieres', function(Blueprint $table)
		{
			$table->foreign('code_diplome', 'fk_filiere_relations_diplome')->references('code_diplome')->on('diplomes')->onUpdate('RESTRICT')->onDelete('RESTRICT');
			$table->foreign('code_etablissement', 'fk_filiere_relations_etabliss')->references('code_etablissement_stat')->on('etablissements')->onUpdate('RESTRICT')->onDelete('RESTRICT');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('filieres', function(Blueprint $table)
		{
			$table->dropForeign('fk_filiere_relations_diplome');
			$table->dropForeign('fk_filiere_relations_etabliss');
		});
	}

}
