<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFuncionariosOficinasTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('funcionarios_oficinas', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('funcionarios_id')->unsigned();
			$table->integer('oficinas_id')->unsigned();
			$table->boolean('ativo');

			$table->foreign('funcionarios_id')->references('id')->on('funcionarios')->on_delete('restrict');
			$table->foreign('oficinas_id')->references('id')->on('oficinas')->on_delete('restrict');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('funcionarios_oficinas');
	}

}