<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateSerieBacsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('serie_bacs', function(Blueprint $table)
		{
			$table->integer('code_serie_baccalaureat_opi')->primary('pk_serie_bac');
			$table->integer('code_serie_baccalaureat_stat')->nullable();
			$table->string('libelle_baccalaureat_fr')->nullable();
			$table->string('libelle_baccalaureat_ar')->nullable();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('serie_bacs');
	}

}
