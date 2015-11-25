<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSituacaoEquipamentosTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('situacao_equipamentos', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('descricao', 180);
			$table->boolean('ativo');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('situacao_equipamentos');
	}

}