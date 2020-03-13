<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateFiliereProvincesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('filiere_provinces', function(Blueprint $table)
		{
			$table->string('code_filiere', 1024);
			$table->integer('code_province_opi');
			$table->primary(['code_filiere','code_province_opi'], 'pk_filiere_province');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('filiere_provinces');
	}

}
