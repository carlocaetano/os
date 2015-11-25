<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFuncionariosTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('funcionarios', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('nome', 80);
			$table->string('matricula', 16);
			$table->date('data_nascimento');
			$table->date('data_admissao');
			$table->date('data_demissao');
			$table->string('naturalidade', 40);
			$table->string('uf_natural', 2);
			$table->string('nacionalidade', 20);
			$table->bigInteger('tel_1')->nullable();
			$table->bigInteger('tel_2')->nullable();
			$table->bigInteger('celular1');
			$table->bigInteger('celular2')->nullable();
			$table->string('rg', 15)->nullable();
			$table->date('data_exped_rg')->nullable();
			$table->string('orgao_exp_rg', 50)->nullable(); //Órgão/UF
			$table->bigInteger('cpf');
			$table->string('email', 80);
			$table->boolean('ativo');
			$table->string('endereco', 255);
			$table->tinyInteger('numero');
			$table->string('bairro', 255);
			$table->string('complemento', 255)->nullable();
			$table->string('cidade', 150);
			$table->string('uf', 2);
			$table->integer('cep');
			$table->string('observacao', 500)->nullable();
			$table->timestamps();

			$table->integer('jornada_id')->unsigned();
			$table->integer('funcao_id')->unsigned();

			$table->foreign('jornada_id')->references('id')->on('jornada_trabalho')->on_delete('restrict');
			$table->foreign('funcao_id')->references('id')->on('funcoes')->on_delete('restrict');

		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('funcionarios');
	}

}