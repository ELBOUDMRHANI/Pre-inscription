<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToCommunesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('communes', function(Blueprint $table)
		{
			$table->foreign('code_province_opi', 'fk_commune_relations_province')->references('code_province_opi')->on('provinces')->onUpdate('RESTRICT')->onDelete('RESTRICT');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('communes', function(Blueprint $table)
		{
			$table->dropForeign('fk_commune_relations_province');
		});
	}

}
