<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCategoriasServicosTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('categorias_servicos', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('descricao', 150);
			$table->boolean('ativo');
			$table->timestamps();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('categorias_servicos', function(Blueprint $table)
		{
			//
		});
	}

}