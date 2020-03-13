<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateFiliereSerieBacsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('filiere_serie_bacs', function(Blueprint $table)
		{
			$table->integer('code_serie_baccalaureat_opi');
			$table->string('code_filiere', 1024);
			$table->primary(['code_serie_baccalaureat_opi','code_filiere'], 'pk_filiere_serie_bac');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('filiere_serie_bacs');
	}

}
