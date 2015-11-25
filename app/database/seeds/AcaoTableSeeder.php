<?php

class AcaoTableSeeder extends Seeder {

    public function run()
    {
      //DB::table('acoes')->delete();

	    Acao::create(array('nome' => 'Acesso total do sistema', 'metodo' => '*'));

	    Acao::create(array('nome' => 'Listar clientes', 'metodo' => 'cliente.index'));
		Acao::create(array('nome' => 'Detalhar clientes', 'metodo' => 'cliente.show'));
		Acao::create(array('nome' => 'Formulário de inclusão de clientes', 'metodo' => 'cliente.create'));
		Acao::create(array('nome' => 'Adicionar clientes', 'metodo' => 'cliente.store'));
		Acao::create(array('nome' => 'Formulário de alteração de clientes', 'metodo' => 'cliente.edit'));
		Acao::create(array('nome' => 'Alterar clientes', 'metodo' => 'cliente.update'));
		Acao::create(array('nome' => 'Apagar clientes', 'metodo' => 'cliente.destroy'));

		Acao::create(array('nome' => 'Listar funcionários', 'metodo' => 'funcionario.index'));
		Acao::create(array('nome' => 'Detalhar funcionário', 'metodo' => 'funcionario.show'));
		Acao::create(array('nome' => 'Formulário de inclusão de funcionário', 'metodo' => 'funcionario.create'));
		Acao::create(array('nome' => 'Adicionar funcionário', 'metodo' => 'funcionario.store'));
		Acao::create(array('nome' => 'Formulário de alteração de funcionário', 'metodo' => 'funcionario.edit'));
		Acao::create(array('nome' => 'Alterar funcionário', 'metodo' => 'funcionario.update'));
		Acao::create(array('nome' => 'Apagar funcionário', 'metodo' => 'funcionario.destroy'));
    	
		Acao::create(array('nome' => 'Listar usuários', 'metodo' => 'usuario.index'));
		Acao::create(array('nome' => 'Formulário de inclusão de usuário', 'metodo' => 'usuario.create'));
		Acao::create(array('nome' => 'Adicionar usuário', 'metodo' => 'usuario.store'));
		Acao::create(array('nome' => 'Formulário de alteração de usuário', 'metodo' => 'usuario.edit'));
		Acao::create(array('nome' => 'Alterar usuário', 'metodo' => 'usuario.update'));
		Acao::create(array('nome' => 'Apagar usuário', 'metodo' => 'usuario.destroy'));

		Acao::create(array('nome' => 'Listar perfil', 'metodo' => 'perfil.index'));
		Acao::create(array('nome' => 'Formulário de inclusão de perfil', 'metodo' => 'perfil.create'));
		Acao::create(array('nome' => 'Adicionar perfil', 'metodo' => 'perfil.store'));
		Acao::create(array('nome' => 'Formulário de alteração de perfil', 'metodo' => 'perfil.edit'));
		Acao::create(array('nome' => 'Alterar perfil', 'metodo' => 'perfil.update'));
		Acao::create(array('nome' => 'Apagar perfil', 'metodo' => 'perfil.destroy'));
	}

}