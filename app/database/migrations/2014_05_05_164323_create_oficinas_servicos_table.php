<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOficinasServicosTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('oficinas_servicos', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('servicos_id')->unsigned();
			$table->integer('oficinas_id')->unsigned();

			$table->foreign('servicos_id')->references('id')->on('servicos')->on_delete('restrict');
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
		Schema::drop('oficinas_servicos');
	}

}