<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCategoriasMateriaisTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('categorias_materiais', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('descricao', 180);
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
		Schema::drop('categorias_materiais');
	}

}