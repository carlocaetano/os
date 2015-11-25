<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAcoesPerfisTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('acoes_perfis', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('acao_id')->unsigned();
			$table->integer('perfil_id')->unsigned();

			$table->foreign('acao_id')->references('id')->on('acoes')->on_delete('restrict');
			$table->foreign('perfil_id')->references('id')->on('perfis')->on_delete('restrict');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('acoes_perfis');
	}

}