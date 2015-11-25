<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMateriaisTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('materiais', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('descricao', 255);
			$table->string('fabricante_marca', 150)->nullable();
			$table->string('unidade', 10);
			$table->tinyInteger('qtde');
			$table->decimal('peso_kg', 6, 1)->nullable();
			$table->date('data_fabricacao')->nullable();
			$table->tinyInteger('estoque_min');
			$table->tinyInteger('estoque_max');
			$table->decimal('preco_custo', 6, 1);
			$table->date('data_cadastro');
			$table->string('observacao', 255)->nullable();
			$table->boolean('ativo');
			$table->string('situacao', 1);

			$table->integer('categoria_id')->unsigned();
			$table->integer('localizacao_id')->unsigned();

			$table->foreign('categoria_id')->references('id')->on('categorias_materiais')->on_delete('restrict');
			$table->foreign('localizacao_id')->references('id')->on('localizacao_materiais')->on_delete('restrict');

		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('materiais');
	}

}