<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsuariosTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('usuarios', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('nome', 120);
			$table->string('username', 25);
			$table->string('password', 80);
			$table->string('email', 120);
			$table->boolean('ativo');
			$table->timestamps();

			$table->integer('perfil_id')->unsigned();
			$table->integer('funcionario_id')->unsigned()->nullable();
			

			$table->foreign('perfil_id')->references('id')->on('perfis')->on_delete('restrict');
			$table->foreign('funcionario_id')->references('id')->on('funcionarios')->on_delete('restrict');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('usuarios', function(Blueprint $table)
		{
			//
		});
	}

}