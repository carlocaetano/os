<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateClientesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('clientes', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('razao_social', 255);
			$table->date('data_cadastro');
			$table->string('nome_fantasia', 255)->nullable();
			$table->string('tp_pessoa', 1);
			$table->bigInteger('cnpj')->nullable();
			$table->bigInteger('cpf')->nullable();
			$table->bigInteger('inscricao_est_rg');
			$table->date('data_exped_rg')->nullable();
			$table->string('orgao_exp_rg', 50)->nullable(); //Órgão/UF
			$table->date('data_nascimento')->nullable();
			$table->string('endereco', 255);
			$table->tinyInteger('numero');
			$table->string('complemento', 150)->nullable();
			$table->string('bairro', 255);
			$table->string('cidade', 150);
			$table->string('uf', 2);
			$table->integer('cep');
			$table->string('ponto_referencia', 200)->nullable();
			$table->bigInteger('tel_1')->nullable();
			$table->bigInteger('tel_2')->nullable();
			$table->bigInteger('tel_3')->nullable();
			$table->bigInteger('celular1')->nullable();
			$table->bigInteger('celular2')->nullable();
			$table->string('email', 80)->nullable();
			$table->string('observacao', 500)->nullable();
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
		Schema::drop('clientes');
	}

}