<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateInfoRecusTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('info_recus', function(Blueprint $table)
		{
			$table->boolean('ville_naiss')->nullable();
			$table->boolean('nom_prenom')->nullable();
			$table->boolean('nom_etab')->nullable();
			$table->bigInteger('id')->primary('info_recus_pkey');
			$table->boolean('filiere')->nullable();
			$table->boolean('diplome')->nullable();
			$table->boolean('date_naiss')->nullable();
			$table->boolean('code_massar')->nullable();
			$table->boolean('cne')->nullable();
			$table->boolean('cache')->nullable();
			$table->boolean('annee_univ')->nullable();
			$table->boolean('num_dossier')->nullable();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('info_recus');
	}

}
