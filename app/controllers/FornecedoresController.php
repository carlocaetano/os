<?php

use Eloquent\Database\Eloquent\ModelNotFoundException;

class FornecedoresController extends BaseController {

	protected $fornecedor;

	public function __construct(Fornecedor $fornecedor)
    {
        parent::__construct();
        $this->fornecedor = $fornecedor;
    }

    public function index()
    {
        $nome_razao_social = $apelido_nome_fantasia = $cnpj = $cpf = $cidade = $uf = $tel_1 = $ativo = null;

        $fields = array('nome_razao_social', 'apelido_nome_fantasia', 'cnpj', 'cpf', 'cidade', 'uf', 'tel_1', 'ativo');
        $sort = in_array(Input::get('sort'), $fields) ? Input::get('sort') : 'nome_razao_social';
        $order = Input::get('order') === 'desc' ? 'desc' : 'asc';

        $fornecedores = $this->fornecedor->orderBy($sort, $order);

        if(Input::has('nome_razao_social')) {
            $fornecedores = $fornecedores->where('nome_razao_social', 'LIKE', "%". Input::get('nome_razao_social') ."%");
            $nome_razao_social = '&nome_razao_social='. Input::get('nome_razao_social');
        }

        if(Input::has('apelido_nome_fantasia')) {
            $fornecedores = $fornecedores->where('apelido_nome_fantasia', 'LIKE', "%". Input::get('apelido_nome_fantasia') ."%");
            $apelido_nome_fantasia = '&apelido_nome_fantasia='. Input::get('apelido_nome_fantasia');
        }

        if(Input::has('cnpj')) {
            $fornecedores = $fornecedores->where('cnpj', '=', Util::limpa_string(Input::get('cnpj')) );
            $cnpj = '&cnpj='. Util::limpa_string(Input::get('cnpj'));
        }

        if(Input::has('cpf')) {
            $fornecedores = $fornecedores->where('cpf', '=', Util::limpa_string(Input::get('cpf')) );
            $cpf = '&cpf='. Util::limpa_string(Input::get('cpf'));
        }

        if(Input::has('cidade')) {
            $fornecedores = $fornecedores->where('cidade', '=', Input::get('cidade') );
            $cidade = '&cidade='. Input::get('cidade');
        }

        if(Input::has('uf')) {
            $fornecedores = $fornecedores->where('uf', '=', Input::get('uf') );
            $uf = '&uf='. Input::get('uf');
        }

        if(Input::has('tel_1')) {
            $fornecedores = $fornecedores->where('tel_1', '=', Util::limpa_string(Input::get('tel_1')) );
            $tel_1 = '&tel_1='. Util::limpa_string(Input::get('tel_1'));
        }

        if(Input::has('ativo')) {
            $fornecedores = $fornecedores->where('ativo', '=', (Input::has('ativo') ? true : false ) );
            $ativo = '&ativo='. (Input::has('ativo') ? true : false );
        }

        $fornecedores = $fornecedores->paginate(10);

        $pagination = $fornecedores->appends(array(
            'apelido_nome_fantasia' => Input::get('apelido_nome_fantasia'),
            'nome_razao_social' => Input::get('nome_razao_social'),
            'cnpj' => Util::limpa_string(Input::get('cnpj')),
            'cpf' => Util::limpa_string(Input::get('cpf')),
            'cidade' => Input::get('cidade'),
            'uf' => Input::get('uf'),
            'tel_1' => Util::limpa_string(Input::get('tel_1')),
            'ativo' => (Input::has('ativo') ? true : false ),
            'sort' => Input::get('sort'),
            'order' => Input::get('order')
        ))->links();

        return View::make('fornecedores.index')
            ->with(array(
                'apelido_nome_fantasia' => Input::get('apelido_nome_fantasia'),
                'nome_razao_social' => Input::get('nome_razao_social'),
                'cnpj' => Util::limpa_string(Input::get('cnpj')),
                'cpf' => Util::limpa_string(Input::get('cpf')),
                'cidade' => Input::get('cidade'),
                'uf' => Input::get('uf'),
                'tel_1' => Util::limpa_string(Input::get('tel_1')),
                'ativo' => (Input::has('ativo') ? true : false ),
                'fornecedores' => $fornecedores,
                'pagination' => $pagination,
                'str' => '&order='.(Input::get('order') == 'asc' || null ? 'desc' : 'asc') . 
                $apelido_nome_fantasia . $nome_razao_social . $cnpj . $cpf . $cidade . $uf . $tel_1 . $ativo));
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
        return View::make('fornecedores.create');
    }

    public function store()
    {
        $input = Input::all();
        $validator = $this->fornecedor->validate($input);

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
            if(Input::has('data_exped_rg')) {
                $input['data_exped_rg'] = Util::toMySQL(Input::get('data_exped_rg'));
            }

            if(Input::has('data_cadastro')) {
                $input['data_cadastro'] = Util::toMySQL(Input::get('data_cadastro'));
            }

            $this->fornecedor->create($input);

            return Redirect::to('fornecedor')
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