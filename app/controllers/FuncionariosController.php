<?php

use Eloquent\Database\Eloquent\ModelNotFoundException;

class FuncionariosController extends BaseController {

	protected $funcionario;

	public function __construct(Funcionario $funcionario)
    {
        parent::__construct();
        $this->funcionario = $funcionario;
    }

    public function index()
    {
        $nome = $data_nascimento = $matricula = $cpf = $funcao_id = $ativo = null;

        $fields = array('nome', 'matricula', 'data_nascimento',  'cpf', 'funcao_id', 'ativo');

        $sort = in_array(Input::get('sort'), $fields) ? Input::get('sort') : 'nome';
        $order = Input::get('order') === 'desc' ? 'desc' : 'asc';

        $funcionarios = $this->funcionario->orderBy($sort, $order)
                             ->join('funcoes', 'funcionarios.funcao_id', '=', 'funcoes.id');

        if(Input::has('nome')) {
            $funcionarios = $funcionarios->where('nome', 'LIKE', "%". Input::get('nome') ."%");
            $nome = '&nome='. Input::get('nome');
        }

        if(Input::has('data_nascimento')) {
            $funcionarios = $funcionarios->where('data_nascimento', '=', Util::toMySQL(Input::get('data_nascimento')) );
            $data_nascimento = '&data_nascimento='. Util::toMySQL(Input::get('data_nascimento'));
        }

        if(Input::has('matricula')) {
            $funcionarios = $funcionarios->where('matricula', '=', Util::limpa_string(Input::get('matricula')) );
            $matricula = '&matricula='. Util::limpa_string(Input::get('matricula'));
        }

        if(Input::has('cpf')) {
            $funcionarios = $funcionarios->where('cpf', '=', Util::limpa_string(Input::get('cpf')) );
            $cpf = '&cpf='. Util::limpa_string(Input::get('cpf'));
        }

        if(Input::has('funcao_id')) {
            $funcionarios = $funcionarios->where('funcao_id', '=', Input::get('funcao_id') );
            $funcao_id = '&funcao_id='. Input::get('funcao_id');
        }

        if(Input::has('ativo') && Input::get('ativo') != "" && Input::get('ativo') <= 1) {
            $funcionarios = $funcionarios
                            ->where('funcionarios.ativo', '=', Input::get('ativo') );
            $ativo = '&ativo='. (Input::has('ativo') ? true : false );
        }

        $funcionarios = $funcionarios->paginate(10, 
            array('funcionarios.id',
                  'funcionarios.nome',
                  'funcionarios.data_nascimento',
                  'funcionarios.matricula',
                  'funcionarios.cpf',
                  'funcionarios.ativo',
                  'funcionarios.created_at',
                  'funcionarios.updated_at',
                  'funcoes.descricao AS funcao'));

        $pagination = $funcionarios->appends(array(
            'nome' => Input::get('nome'),
            'data_nascimento' => Util::toView(Input::get('data_nascimento')),
            'matricula' => Util::limpa_string(Input::get('matricula')),
            'cpf' => Util::limpa_string(Input::get('cpf')),
            'funcao_id' => Input::get('funcao_id'),
            'ativo' => (Input::has('ativo') ? true : false ),
            'sort' => Input::get('sort'),
            'order' => Input::get('order')
        ))->links();

        return View::make('funcionarios.index')
            ->with(array(
                'nome' => Input::get('nome'),
                'data_nascimento' => Util::toView(Input::get('data_nascimento')),
                'matricula' => Util::limpa_string(Input::get('matricula')),
                'cpf' => Util::limpa_string(Input::get('cpf')),
                'funcao_id' => Input::get('funcao_id'),
                'ativo' => (Input::has('ativo') ? true : false ),
                'funcionarios' => $funcionarios,
                'pagination' => $pagination,
                'str' => '&order='.(Input::get('order') == 'asc' || null ? 'desc' : 'asc') . 
                $nome . $data_nascimento . $matricula . $cpf . $funcao_id . $ativo
        ));
    }

    public function show($id)
    {
        try {

            // $funcionario = $this->funcionario->findOrFail($id)
            //                 ->join('funcoes', 'funcionarios.funcao_id', '=', 'funcoes.id');

            $funcionario = $this->funcionario
                            ->where('funcionarios.id',$id)
                            ->join('funcoes','funcionarios.funcao_id','=','funcoes.id')
                            ->join('jornada_trabalho', 'funcionarios.jornada_id', '=', 'jornada_trabalho.id')
                            ->select('funcionarios.id',
                                     'funcionarios.nome',
                                     'funcionarios.matricula',
                                     'funcionarios.data_nascimento',
                                     'funcionarios.data_admissao',
                                     'funcionarios.data_demissao',
                                     'funcionarios.naturalidade',
                                     'funcionarios.uf_natural',
                                     'funcionarios.nacionalidade',
                                     'funcionarios.tel_1',
                                     'funcionarios.tel_2',
                                     'funcionarios.celular1',
                                     'funcionarios.celular2',
                                     'funcionarios.rg',
                                     'funcionarios.data_exped_rg',
                                     'funcionarios.orgao_exp_rg',
                                     'funcionarios.cpf',
                                     'funcionarios.email',
                                     'funcionarios.ativo',
                                     'funcionarios.endereco',
                                     'funcionarios.numero',
                                     'funcionarios.complemento',
                                     'funcionarios.bairro',
                                     'funcionarios.cidade',
                                     'funcionarios.uf',
                                     'funcionarios.cep',
                                     'funcionarios.observacao',
                                     'funcionarios.jornada_id',
                                     'funcionarios.funcao_id',
                                     'funcionarios.created_at',
                                     'funcionarios.updated_at',
                                     'funcoes.descricao AS funcao',
                                     'jornada_trabalho.hr_inicial AS hr_inicial',
                                     'jornada_trabalho.inter_hr_inicial AS inter_hr_inicial', 
                                     'jornada_trabalho.inter_hr_final AS inter_hr_final',
                                     'jornada_trabalho.hr_final AS hr_final',
                                     'jornada_trabalho.HR_TEMPO AS HR_TEMPO')
                                     ->first();

            return View::make('funcionarios.show', compact('funcionario'));

        } catch(ModelNotFoundException $e) {
            return Redirect::to('funcionario')
                ->with('danger', Util::message('MSG003'));
        }
    }

    public function create()
    {
        return View::make('funcionarios.create');
    }

    public function store()
    {
        $input = Input::all();
        $validator = $this->funcionario->validate($input);

        if($validator->fails()) {
            return Redirect::back()
                ->withInput()
                ->withErrors($validator)
                ->with('danger', Util::message('MSG001'));
        } else {

            //limpa os caracteres para armazenar no banco de dados
            $input['cpf'] = Util::limpa_string(Input::get('cpf'));
            $input['cep'] = Util::limpa_string(Input::get('cep'));
            $input['tel_1'] = Util::limpa_string(Input::get('tel_1'));
            $input['tel_2'] = Util::limpa_string(Input::get('tel_2'));
            $input['celular1'] = Util::limpa_string(Input::get('celular1'));
            $input['celular2'] = Util::limpa_string(Input::get('celular2'));

            //Altera os valores das flags
            $input['ativo'] = (Input::has('ativo') ? true : false );

            //Altera o formato das datas
            $input['data_nascimento'] = Util::toMySQL(Input::get('data_nascimento'));
            $input['data_admissao'] = Util::toMySQL(Input::get('data_admissao'));

            if(Input::has('data_exped_rg')) {
                $input['data_exped_rg'] = Util::toMySQL(Input::get('data_exped_rg'));
            }

            if(Input::has('data_demissao')) {
                $input['data_demissao'] = Util::toMySQL(Input::get('data_demissao'));
            }

            $this->funcionario->create($input);

            return Redirect::to('funcionario')
                ->with('success', Util::message('MSG002'));
        }
    }

    public function edit($id)
    {
        try {
            $funcionario = $this->funcionario->findOrFail($id);
            return View::make('funcionarios.edit', compact('funcionario'));
        } catch(ModelNotFoundException $e) {
            return Redirect::to('funcionario')
                ->with('danger', Util::message('MSG003'));
        }
    }

    public function update($id)
    {
        $input = Input::all();
        $validator = $this->funcionario->validate($input);

        if($validator->fails()){
            return Redirect::back()
                ->withInput()
                ->withErrors($validator)
                ->with('danger', Util::message('MSG004'));
        } else {
            //limpa os caracteres para armazenar no banco de dados
            $input['cpf'] = Util::limpa_string(Input::get('cpf'));
            $input['cep'] = Util::limpa_string(Input::get('cep'));
            $input['tel_1'] = Util::limpa_string(Input::get('tel_1'));
            $input['tel_2'] = Util::limpa_string(Input::get('tel_2'));
            $input['celular1'] = Util::limpa_string(Input::get('celular1'));
            $input['celular2'] = Util::limpa_string(Input::get('celular2'));

            //Altera os valores das flags
            $input['ativo'] = (Input::has('ativo') ? true : false );

            //Altera o formato das datas
            $input['data_nascimento'] = Util::toMySQL(Input::get('data_nascimento'));
            $input['data_admissao'] = Util::toMySQL(Input::get('data_admissao'));

            if(Input::has('data_exped_rg')) {
                $input['data_exped_rg'] = Util::toMySQL(Input::get('data_exped_rg'));
            }

            if(Input::has('data_demissao')) {
                $input['data_demissao'] = Util::toMySQL(Input::get('data_demissao'));
            }

            $this->funcionario->find($id)->update($input);

            return Redirect::to('funcionario')
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