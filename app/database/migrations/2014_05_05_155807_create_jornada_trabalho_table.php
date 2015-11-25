<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateJornadaTrabalhoTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('jornada_trabalho', function(Blueprint $table)
		{
			$table->increments('id');
			$table->time('hr_inicial');
			$table->time('hr_final');
			$table->time('inter_hr_inicial');
			$table->time('inter_hr_final');
			$table->time('HR_TEMPO'); //Tempo total Diário da escala
			$table->boolean('situacao');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('jornada_trabalho');
	}

}