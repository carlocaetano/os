<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMateriaisFornecedoresTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('materiais_fornecedores', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('materiais_id')->unsigned();
			$table->integer('fonecedores_id')->unsigned();
			$table->date('data_cadastro');

			$table->foreign('materiais_id')->references('id')->on('materiais')->on_delete('restrict');
			$table->foreign('fonecedores_id')->references('id')->on('fornecedores')->on_delete('restrict');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('materiais_fornecedores');
	}

}