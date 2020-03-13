<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToCodePostalesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('code_postales', function(Blueprint $table)
		{
			$table->foreign('code_region', 'fk_region_code_postale')->references('code_region_stat')->on('regions')->onUpdate('RESTRICT')->onDelete('RESTRICT');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('code_postales', function(Blueprint $table)
		{
			$table->dropForeign('fk_region_code_postale');
		});
	}

}
