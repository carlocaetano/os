<?php

use Eloquent\Database\Eloquent\ModelNotFoundException;

class UsuariosController extends BaseController {

	protected $usuario;

	public function __construct(Usuario $usuario)
    {
        parent::__construct();
        $this->usuario = $usuario;
    }

    public function login()
    {
    	return View::make('usuarios.login');
    }

    public function validate()
    {
    	$user = array(
    		'username' => Input::get('username'),
    		'password' => Input::get('password')
    	);

    	if(Auth::attempt($user))
    	{
    		if(!Auth::user()->ativo) {
    			
    			Auth::logout();
    			return Redirect::to('login')
    				->with('flash_error', Util::message('MSG012'));
    		}

    		return Redirect::to('welcome')
    			->with('info', Util::message('MSG008'));
    	}

    	return Redirect::to('login')
    			->with('flash_error', Util::message('MSG009'))
    			->withInput();
    }

    public function welcome()
    {
        if(!Cache::has('actions' . Auth::user()->id)) {
            foreach (Auth::user()->perfil->acoes as $acao) {
                $actions[] = $acao->metodo;
            }
            Cache::put('actions'. Auth::user()->id, $actions, 120);
        }
    	return View::make('usuarios.welcome');
    }

    public function logout()
    {
        if(Cache::has('actions' . Auth::user()->id)) {
            Cache::forget('actions' . Auth::user()->id);
        }
    	Auth::logout();
    	return Redirect::to('login')
    				->with('flash_notice', Util::message('MSG010'));
    }

    public function index()
    {
        $nome = $perfil = null;

        $fields = array('nome', 'perfil', 'username', 'email', 'ativo', 'created_at', 'updated_at', );
        $sort = in_array(Input::get('sort'), $fields) ? Input::get('sort') : 'nome';
        $order = Input::get('order') === 'desc' ? 'desc' : 'asc';

        $usuarios = $this->usuario->orderBy($sort, $order)
                         ->join('perfis', 'usuarios.perfil_id', '=', 'perfis.id')
                         ->where('usuarios.username', '!=', 'admin');

        if(Auth::user()->perfil_id != 1) {
            $usuarios = $usuarios->where('usuarios.id', '=', Auth::user()->id);
        }

        if(Input::has('nome')) {
            $usuarios = $usuarios->where('usuarios.nome', 'LIKE', "%". Input::get('nome') ."%");
            $nome = '&nome='. Input::get('nome');
        }

        if(Input::has('perfil')) {
            $usuarios = $usuarios->where('perfis.descricao', 'LIKE', "%". Input::get('perfil') ."%");
            $perfil = '&perfil='. Input::get('perfil');
        }

        $usuarios = $usuarios->paginate(15, array('usuarios.id', 'usuarios.nome', 'usuarios.username', 'usuarios.email','usuarios.ativo', 'usuarios.created_at', 'usuarios.updated_at', 'perfis.descricao AS perfil'));

        $pagination = $usuarios->appends(array(
            'nome' => Input::get('nome'),
            'perfil' => Input::get('perfil'),
            'sort' => Input::get('sort'),
            'order' => Input::get('order')
        ))->links();

        return View::make('usuarios.index')
            ->with(array(
                'nome' => Input::get('nome'),
                'perfil' => Input::get('perfil'),
                'usuarios' => $usuarios,
                'pagination' => $pagination,
                'str' => '&order='.(Input::get('order') == 'asc' || null ? 'desc' : 'asc') . $nome . $perfil
        ));
    }

    public function create()
    {
        return View::make('usuarios.create');
    }

    public function store()
    {
        $input = Input::all();
        $validator = $this->usuario->validate($input);

        if($validator->fails()) {
            return Redirect::back()
                ->withInput()
                ->withErrors($validator)
                ->with('danger', Util::message('MSG001'));
        } else {
            $input['password'] = Hash::make(Input::get('password'));
            $this->usuario->create($input);

            return Redirect::to('usuario')
                ->with('success', Util::message('MSG002'));
        }
    }

    public function edit($id)
    {
        try {

            if(Auth::user()->perfil_id != 1 || Auth::user()->id != 1) {
                $id = Auth::user()->id;
            }

            $usuario = $this->usuario->findOrFail($id);
            return View::make('usuarios.edit', compact('usuario'));
        } catch(ModelNotFoundException $e) {
            return Redirect::to('usuario')
                ->with('danger', Util::message('MSG003'));
        }
    }

    public function update($id)
    {
        $input = Input::all();
        $validator = $this->usuario->validate($input);

        if($validator->fails()){
            return Redirect::back()
                ->withInput()
                ->withErrors($validator)
                ->with('danger', Util::message('MSG004'));

        } else {
            if($input['password'] === '') {
                unset($input['password']);
            }
            else {
                $input['password'] = Hash::make(Input::get('password'));
            }

            $this->usuario->find($id)->update($input);

            return Redirect::to('usuario')
                ->with('success', Util::message('MSG005'));
        }
    }

    public function destroy($id)
    {
        try {

            if(Auth::user()->perfil_id != 1 || Auth::user()->id != 1) {
                $id = Auth::user()->id;
            }   

            $this->usuario->find($id)->delete();
            return Redirect::to('usuario')
                ->with('success', Util::message('MSG006'));
        } catch (Exception $e) {
            return Redirect::to('usuario')
                ->with('warning', Util::message('MSG007'));
        }
    }
}