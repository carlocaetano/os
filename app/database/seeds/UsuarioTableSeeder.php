<?php

class UsuarioTableSeeder extends Seeder {

    public function run()
    {
        DB::table('usuarios')->delete();

		Usuario::create(array(
			'nome' => 'Administrador',
			'username' => 'admin',
			'password' => Hash::make('admin2014'),
			'email' => 'admin@osprime.com.br',
			'ativo' => true,
			'perfil_id' => 1,
			'funcionario_id' => null
		));
	}

}