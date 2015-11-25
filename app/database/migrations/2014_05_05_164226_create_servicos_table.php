<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateServicosTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('servicos', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('descricao', 150);
			$table->tinyInteger('min_hr')->nullable();
			$table->tinyInteger('min_min')->nullable();
			$table->tinyInteger('max_hr')->nullable();
			$table->tinyInteger('max_min')->nullable();
			$table->string('prioridade', 1);
			$table->boolean('ativo');

			$table->timestamps();

			$table->integer('categoria_id')->unsigned();

			$table->foreign('categoria_id')->references('id')->on('categorias_servicos')->on_delete('restrict');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('servicos', function(Blueprint $table)
		{
			//
		});
	}

}