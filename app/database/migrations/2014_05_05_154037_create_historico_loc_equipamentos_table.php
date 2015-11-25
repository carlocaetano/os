<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHistoricoLocEquipamentosTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('historico_loc_equipamentos', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('equipamentos_id')->unsigned();
			$table->integer('locallizacao_id')->unsigned();
			$table->date('data_alteracao');

			$table->foreign('equipamentos_id')->references('id')->on('equipamentos')->on_delete('restrict');
			$table->foreign('locallizacao_id')->references('id')->on('localizacao_equipamentos')->on_delete('restrict');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('historico_loc_equipamentos');
	}

}