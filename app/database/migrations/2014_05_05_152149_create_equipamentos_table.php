<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEquipamentosTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('equipamentos', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('descricao', 80);
			$table->string('fabricante', 80)->nullable();
			$table->string('modelo', 80)->nullable();
			$table->boolean('ativo');
			$table->date('data_fabricacao')->nullable();
			$table->text('observacao')->nullable();
			$table->decimal('peso_kg')->nullable();
			$table->string('nr_patrimonio', 9)->nullable();
			$table->date('data_cadastro');
			$table->string('situacao', 1);

			$table->integer('categoria_id')->unsigned();
			$table->integer('situacao_id')->unsigned();
			$table->integer('localizacao_id')->unsigned();
			$table->integer('cliente_id')->unsigned();

			$table->foreign('categoria_id')->references('id')->on('categorias_equipamentos')->on_delete('restrict');

			$table->foreign('localizacao_id')->references('id')->on('localizacao_equipamentos')->on_delete('restrict');

			$table->foreign('cliente_id')->references('id')->on('clientes')->on_delete('restrict');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('equipamentos');
	}

}