<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToProvincesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('provinces', function(Blueprint $table)
		{
			$table->foreign('code_region_stat', 'fk_region_province')->references('code_region_stat')->on('regions')->onUpdate('RESTRICT')->onDelete('RESTRICT');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('provinces', function(Blueprint $table)
		{
			$table->dropForeign('fk_region_province');
		});
	}

}
