<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOficinasTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('oficinas', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('descricao', 150);
			$table->string('caminho_impressora', 255);
			$table->boolean('situacao');
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
		Schema::drop('oficinas');
	}

}