<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEquipamentosClientesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('equipamentos_clientes', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('equipamentos_id')->unsigned();
			$table->integer('clientes_id')->unsigned();
			$table->timestamps();

			$table->foreign('equipamentos_id')->references('id')->on('clientes')->on_delete('restrict');
			
			$table->foreign('clientes_id')->references('id')->on('equipamentos')->on_delete('restrict');
		});

	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('equipamentos_clientes');
	}

}