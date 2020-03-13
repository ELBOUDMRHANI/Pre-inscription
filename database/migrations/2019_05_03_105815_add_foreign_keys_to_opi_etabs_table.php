<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToOpiEtabsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('opi_etabs', function(Blueprint $table)
		{
			$table->foreign('code_filiere', 'fk_filiere_opi_etab')->references('code_filiere_stat')->on('filieres')->onUpdate('RESTRICT')->onDelete('RESTRICT');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('opi_etabs', function(Blueprint $table)
		{
			$table->dropForeign('fk_filiere_opi_etab');
		});
	}

}
