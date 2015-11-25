<?php

class PerfilTableSeeder extends Seeder {

    public function run()
    {
        DB::table('perfis')->delete();

		$perfil = Perfil::create(array(
			'descricao' => 'Administrador',
		));

		$perfil->acoes()->sync(array(1));
	}

}