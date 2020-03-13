<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateCommunesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('communes', function(Blueprint $table)
		{
			$table->integer('code_province_opi');
			$table->string('libelle_commune_fr')->nullable();
			$table->string('libelle_commune_ar')->nullable();
			$table->string('id_commune_stat')->primary('pk_commune');
			$table->integer('code_province_stat')->nullable();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('communes');
	}

}
