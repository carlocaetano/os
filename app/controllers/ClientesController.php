<?php

use Eloquent\Database\Eloquent\ModelNotFoundException;

class ClientesController extends BaseController {

	protected $cliente;

	public function __construct(Cliente $cliente)
    {
        parent::__construct();
        $this->cliente = $cliente;
    }

    public function index()
    {
        $razao_social = $nome_fantasia = $cnpj = $cpf = $cidade = $uf = $tel_1 = $celular1 = $ativo = null;

        $fields = array('razao_social', 'nome_fantasia', 'cnpj', 'cpf', 'cidade', 'uf', 'tel_1', 'celular1', 'ativo');
        $sort = in_array(Input::get('sort'), $fields) ? Input::get('sort') : 'razao_social';
        $order = Input::get('order') === 'desc' ? 'desc' : 'asc';

        $clientes = $this->cliente->orderBy($sort, $order);

        if(Input::has('razao_social')) {
            $clientes = $clientes->where('razao_social', 'LIKE', "%". Input::get('razao_social') ."%");
            $razao_social = '&razao_social='. Input::get('razao_social');
        }

        if(Input::has('nome_fantasia')) {
            $clientes = $clientes->where('nome_fantasia', 'LIKE', "%". Input::get('nome_fantasia') ."%");
            $nome_fantasia = '&nome_fantasia='. Input::get('nome_fantasia');
        }

        if(Input::has('cnpj')) {
            $clientes = $clientes->where('cnpj', '=', Util::limpa_string(Input::get('cnpj')) );
            $cnpj = '&cnpj='. Util::limpa_string(Input::get('cnpj'));
        }

        if(Input::has('cpf')) {
            $clientes = $clientes->where('cpf', '=', Util::limpa_string(Input::get('cpf')) );
            $cpf = '&cpf='. Util::limpa_string(Input::get('cpf'));
        }

        if(Input::has('cidade')) {
            $clientes = $clientes->where('cidade', '=', Input::get('cidade') );
            $cidade = '&cidade='. Input::get('cidade');
        }

        if(Input::has('uf')) {
            $clientes = $clientes->where('uf', '=', Input::get('uf') );
            $uf = '&uf='. Input::get('uf');
        }

        if(Input::has('tel_1')) {
            $clientes = $clientes->where('tel_1', '=', Util::limpa_string(Input::get('tel_1')) );
            $tel_1 = '&tel_1='. Util::limpa_string(Input::get('tel_1'));
        }
        
        if(Input::has('celular1')) {
            $clientes = $clientes->where('celular1', '=', Util::limpa_string(Input::get('celular1')) );
            $celular1 = '&celular1='. Util::limpa_string(Input::get('celular1'));
        }

        if(Input::has('ativo')) {
            $clientes = $clientes->where('ativo', '=', (Input::has('ativo') ? true : false ) );
            $ativo = '&ativo='. (Input::has('ativo') ? true : false );
        }

        $clientes = $clientes->paginate(10);

        $pagination = $clientes->appends(array(
            'nome_fantasia' => Input::get('nome_fantasia'),
            'razao_social' => Input::get('razao_social'),
            'cnpj' => Util::limpa_string(Input::get('cnpj')),
            'cpf' => Util::limpa_string(Input::get('cpf')),
            'cidade' => Input::get('cidade'),
            'uf' => Input::get('uf'),
            'tel_1' => Util::limpa_string(Input::get('tel_1')),
            'celular1' => Util::limpa_string(Input::get('celular1')),
            'ativo' => (Input::has('ativo') ? true : false ),
            'sort' => Input::get('sort'),
            'order' => Input::get('order')
        ))->links();

        return View::make('clientes.index')
            ->with(array(
                'nome_fantasia' => Input::get('nome_fantasia'),
                'razao_social' => Input::get('razao_social'),
                'cnpj' => Util::limpa_string(Input::get('cnpj')),
                'cpf' => Util::limpa_string(Input::get('cpf')),
                'cidade' => Input::get('cidade'),
                'uf' => Input::get('uf'),
                'tel_1' => Util::limpa_string(Input::get('tel_1')),
                'celular1' => Util::limpa_string(Input::get('celular1')),
                'ativo' => (Input::has('ativo') ? true : false ),
                'clientes' => $clientes,
                'pagination' => $pagination,
                'str' => '&order='.(Input::get('order') == 'asc' || null ? 'desc' : 'asc') . 
                $nome_fantasia . $razao_social . $cnpj . $cpf . $cidade . $uf . $tel_1 . $celular1
        ));
    }

    public function show($id)
    {
        try {
            $cliente = $this->cliente->findOrFail($id);
            return View::make('clientes.show', compact('cliente'));
        } catch(ModelNotFoundException $e) {
            return Redirect::to('cliente')
                ->with('danger', Util::message('MSG003'));
        }
    }

    public function create()
    {
        return View::make('clientes.create');
    }

    public function store()
    {
        $input = Input::all();
        $validator = $this->cliente->validate($input);

        if($validator->fails()) {
            return Redirect::back()
                ->withInput()
                ->withErrors($validator)
                ->with('danger', Util::message('MSG001'));
        } else {

            //limpa os caracteres para armazenar no banco de dados
            $input['cnpj'] = Util::limpa_string(Input::get('cnpj'));
            $input['cpf'] = Util::limpa_string(Input::get('cpf'));
            $input['cep'] = Util::limpa_string(Input::get('cep'));
            $input['tel_1'] = Util::limpa_string(Input::get('tel_1'));
            $input['tel_2'] = Util::limpa_string(Input::get('tel_2'));
            $input['tel_3'] = Util::limpa_string(Input::get('tel_3'));
            $input['celular1'] = Util::limpa_string(Input::get('celular1'));
            $input['celular2'] = Util::limpa_string(Input::get('celular2'));

            //Altera os valores das flags
            $input['ativo'] = (Input::has('ativo') ? true : false );

            //Altera o formato das datas
            $input['data_cadastro'] = Util::toMySQL(Input::get('data_cadastro'));
            $input['data_nascimento'] = Util::toMySQL(Input::get('data_nascimento'));
            $input['data_exped_rg'] = Util::toMySQL(Input::get('data_exped_rg'));

            $this->cliente->create($input);

            return Redirect::to('cliente')
                ->with('success', Util::message('MSG002'));
        }
    }

    public function edit($id)
    {
        try {
            $cliente = $this->cliente->findOrFail($id);
            return View::make('clientes.edit', compact('cliente'));
        } catch(ModelNotFoundException $e) {
            return Redirect::to('cliente')
                ->with('danger', Util::message('MSG003'));
        }
    }

    public function update($id)
    {
        $input = Input::all();
        $validator = $this->cliente->validate($input);

        if($validator->fails()){
            return Redirect::back()
                ->withInput()
                ->withErrors($validator)
                ->with('danger', Util::message('MSG004'));
        } else {
            //limpa os caracteres para armazenar no banco de dados
            $input['cnpj'] = Util::limpa_string(Input::get('cnpj'));
            $input['cpf'] = Util::limpa_string(Input::get('cpf'));
            $input['cep'] = Util::limpa_string(Input::get('cep'));
            $input['tel_1'] = Util::limpa_string(Input::get('tel_1'));
            $input['tel_2'] = Util::limpa_string(Input::get('tel_2'));
            $input['tel_3'] = Util::limpa_string(Input::get('tel_3'));
            $input['celular1'] = Util::limpa_string(Input::get('celular1'));
            $input['celular2'] = Util::limpa_string(Input::get('celular2'));
            
            //Altera os valores das flags
            $input['ativo'] = (Input::has('ativo') ? true : false );

            //Altera o formato das datas
            $input['data_cadastro'] = Util::toMySQL(Input::get('data_cadastro'));
            $input['data_nascimento'] = Util::toMySQL(Input::get('data_nascimento'));
            $input['data_exped_rg'] = Util::toMySQL(Input::get('data_exped_rg'));

            //var_dump($input);
            $this->cliente->find($id)->update($input);

            return Redirect::to('cliente')
                ->with('success', Util::message('MSG005'));
        }
    }

    public function destroy($id)
    {
        try {
            $this->cliente->find($id)->delete();
            return Redirect::to('cliente')
                ->with('success', Util::message('MSG006'));
        } catch (Exception $e) {
            return Redirect::to('cliente')
                ->with('warning', Util::message('MSG007'));
        }
    }

}