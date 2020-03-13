<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateAcademiesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('academies', function(Blueprint $table)
		{
			$table->string('code_academie')->primary('pk_academie');
			$table->integer('code_academie_stat')->nullable();
			$table->string('libelle_academie_fr')->nullable();
			$table->string('libelle_academie_ar')->nullable();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('academies');
	}

}
