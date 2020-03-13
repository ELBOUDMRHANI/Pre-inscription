<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToFiliereSerieBacsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('filiere_serie_bacs', function(Blueprint $table)
		{
			$table->foreign('code_filiere', 'fk_filiere__filiere_s_filiere')->references('code_filiere_stat')->on('filieres')->onUpdate('RESTRICT')->onDelete('RESTRICT');
			$table->foreign('code_serie_baccalaureat_opi', 'fk_filiere__filiere_s_serie_ba')->references('code_serie_baccalaureat_opi')->on('serie_bacs')->onUpdate('RESTRICT')->onDelete('RESTRICT');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('filiere_serie_bacs', function(Blueprint $table)
		{
			$table->dropForeign('fk_filiere__filiere_s_filiere');
			$table->dropForeign('fk_filiere__filiere_s_serie_ba');
		});
	}

}
