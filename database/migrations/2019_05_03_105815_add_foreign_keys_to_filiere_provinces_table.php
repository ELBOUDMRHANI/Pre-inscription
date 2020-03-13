<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToFiliereProvincesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('filiere_provinces', function(Blueprint $table)
		{
			$table->foreign('code_filiere', 'fk_filiere__filiere_p_filiere')->references('code_filiere_stat')->on('filieres')->onUpdate('RESTRICT')->onDelete('RESTRICT');
			$table->foreign('code_province_opi', 'fk_filiere__filiere_p_province')->references('code_province_opi')->on('provinces')->onUpdate('RESTRICT')->onDelete('RESTRICT');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('filiere_provinces', function(Blueprint $table)
		{
			$table->dropForeign('fk_filiere__filiere_p_filiere');
			$table->dropForeign('fk_filiere__filiere_p_province');
		});
	}

}
