<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEquipamentosFornecedoresTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('equipamentos_fornecedores', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('equipamentos_id')->unsigned();
			$table->integer('fonecedores_id')->unsigned();
			$table->timestamps();
			
			$table->foreign('equipamentos_id')->references('id')->on('equipamentos')->on_delete('restrict');
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
		Schema::drop('equipamentos_fornecedores');
	}

}