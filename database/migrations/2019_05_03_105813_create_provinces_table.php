<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateProvincesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('provinces', function(Blueprint $table)
		{
			$table->integer('code_province_opi')->primary('pk_province');
			$table->integer('code_province_stat')->nullable()->unique('province_code_province_stat_key');
			$table->string('libelle_province_fr')->nullable();
			$table->string('libelle_province_ar')->nullable();
			$table->integer('code_region_stat')->nullable();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('provinces');
	}

}
