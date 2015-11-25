<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

Route::get('/', function()
{
	if(Auth::check()) {
		return View::make('usuarios.welcome');
	} else {
		return View::make('usuarios.login');	
	}
	
});

Route::resource('login', 'UsuariosController@login');
Route::post('login', 'UsuariosController@validate');

Route::group(array('before' => 'auth|acl'), function()
{
	Route::get('logout', array('uses' => 'UsuariosController@logout', 'as' => 'usuario.logout'));
	Route::get('welcome', array('uses' => 'UsuariosController@welcome', 'as' => 'usuario.welcome'));
	Route::resource('veiculo', 'VeiculosController');
	Route::resource('cliente', 'ClientesController');
	Route::resource('funcao', 'FuncoesController');
	Route::resource('jornada', 'JornadaTrabalhoController');
	Route::resource('funcionario', 'FuncionariosController');
	Route::resource('fornecedor', 'FornecedoresController');
	Route::resource('categorias_equip', 'CategoriaEquipamentosController');
	Route::resource('categorias_mat', 'CategoriaMateriaisController');
	Route::resource('categorias_servicos', 'CategoriaServicosController');
	Route::resource('localizacao', 'LocalizacaoEquipamentosController');
	Route::resource('localizacao_mat', 'LocalizacaoMateriaisController');
	Route::resource('equipamento', 'EquipamentosController');
	Route::resource('material', 'MateriaisController');
	Route::resource('servico', 'ServicosController');
	Route::resource('usuario', 'UsuariosController', array('except' => array('show')));
	Route::resource('perfil', 'PerfisController', array('except' => array('show')));

});