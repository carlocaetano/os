<?php

use Eloquent\Database\Eloquent\ModelNotFoundException;

class EquipamentosController extends BaseController {

	protected $equipamento;

	public function __construct(Equipamento $equipamento)
    {
        parent::__construct();
        $this->equipamento = $equipamento;
    }

    public function index()
    {
        $descricao = $categoria_id = $localizacao_id = $cliente_id = $nr_patrimonio = null;

        $fields = array('descricao', 'categoria_id', 'localizacao_id', 'cliente_id', 'nr_patrimonio');
        $sort = in_array(Input::get('sort'), $fields) ? Input::get('sort') : 'descricao';
        $order = Input::get('order') === 'desc' ? 'desc' : 'asc';

        $equipamentos = $this->equipamento->orderBy($sort, $order)
                             ->join('localizacao_equipamentos', 'equipamentos.localizacao_id', '=', 'localizacao_equipamentos.id')
                             ->join('categorias_equipamentos', 'equipamentos.categoria_id', '=', 'categorias_equipamentos.id')
                             ->join('clientes', 'equipamentos.cliente_id', '=', 'clientes.id');

        if(Input::has('descricao')) {
            $equipamentos = $equipamentos->where('descricao', '=', Input::get('descricao') );
            $descricao = '&descricao='. Input::get('descricao');
        }

        if(Input::has('categoria_id')) {
            $equipamentos = $equipamentos->where('categoria_id', '=', Input::get('categoria_id') );
            $categoria_id = '&categoria_id='. Input::get('categoria_id');
        }

        if(Input::has('localizacao_id')) {
            $equipamentos = $equipamentos->where('localizacao_id', '=', Input::get('localizacao_id') );
            $localizacao_id = '&localizacao_id='. Input::get('cnpj');
        }

        if(Input::has('cliente_id')) {
            $equipamentos = $equipamentos->where('cliente_id', '=', Input::get('cliente_id') );
            $cliente_id = '&cliente_id='. Input::get('cliente_id');
        }

        if(Input::has('nr_patrimonio')) {
            $equipamentos = $equipamentos->where('nr_patrimonio', '=', Input::get('nr_patrimonio') );
            $nr_patrimonio = '&nr_patrimonio='. Input::get('nr_patrimonio');
        }

        $equipamentos = $equipamentos->paginate(10,
            array('equipamentos.id',
                  'equipamentos.descricao',
                  'equipamentos.fabricante',
                  'equipamentos.nr_patrimonio',
                  'equipamentos.situacao',
                  'equipamentos.ativo',
                  'localizacao_equipamentos.descricao As localizacao',
                  'categorias_equipamentos.descricao As categoria',
                  'clientes.razao_social As cliente'));

        $pagination = $equipamentos->appends(array(
            'descricao' => Input::get('descricao'),
            'categoria_id' => Input::get('categoria_id'),
            'localizacao_id' => Input::get('localizacao_id'),
            'cliente_id' => Input::get('cliente_id'),
            'nr_patrimonio' => Input::get('nr_patrimonio'),
            'sort' => Input::get('sort'),
            'order' => Input::get('order')
        ))->links();

        return View::make('equipamentos.index')
            ->with(array(
                'descricao' => Input::get('descricao'),
                'categoria_id' => Input::get('categoria_id'),
                'localizacao_id' => Input::get('localizacao_id'),
                'cliente_id' => Input::get('cliente_id'),
                'nr_patrimonio' => Input::get('nr_patrimonio'),
                'equipamentos' => $equipamentos,
                'pagination' => $pagination,
                'str' => '&order='.(Input::get('order') == 'asc' || null ? 'desc' : 'asc') . 
                $descricao . $categoria_id . $localizacao_id . $cliente_id . $nr_patrimonio));
    }

    public function show($id)
    {
        try {

             $equipamento = $this->equipamento
                            ->where('equipamentos.id',$id)
                            ->join('localizacao_equipamentos','equipamentos.localizacao_id','=','localizacao_equipamentos.id')
                            ->join('categorias_equipamentos', 'equipamentos.categoria_id', '=', 'categorias_equipamentos.id')
                            ->join('clientes', 'equipamentos.cliente_id', '=', 'clientes.id')
                            ->select('equipamentos.id',
                                     'equipamentos.descricao',
                                     'equipamentos.modelo',
                                     'equipamentos.data_fabricacao',
                                     'equipamentos.data_cadastro',
                                     'equipamentos.peso_kg',
                                     'equipamentos.fabricante',
                                     'equipamentos.nr_patrimonio',
                                     'equipamentos.situacao',
                                     'equipamentos.ativo',
                                     'equipamentos.observacao',
                                     'localizacao_equipamentos.descricao As localizacao',
                                     'categorias_equipamentos.descricao As categoria',
                                     'clientes.razao_social As cliente')->first();

            return View::make('equipamentos.show', compact('equipamento'));

        } catch(ModelNotFoundException $e) {
            return Redirect::to('equipamento')
                ->with('danger', Util::message('MSG003'));
        }
    }

    public function create()
    {
        return View::make('equipamentos.create');
    }

    public function store()
    {
        $input = Input::all();
        $validator = $this->equipamento->validate($input);

        if($validator->fails()) {
            return Redirect::back()
                ->withInput()
                ->withErrors($validator)
                ->with('danger', Util::message('MSG001'));
        } else {

            //Altera os valores das flags
            $input['ativo'] = (Input::has('ativo') ? true : false );

            //Altera o formato das datas
            if(Input::has('data_cadastro')) {
                $input['data_cadastro'] = Util::toMySQL(Input::get('data_cadastro'));
            }

            if(Input::has('data_fabricacao')) {
                $input['data_fabricacao'] = Util::toMySQL(Input::get('data_fabricacao'));
            }

            $this->equipamento->create($input);

            return Redirect::to('equipamento')
                ->with('success', Util::message('MSG002'));
        }
    }

    public function edit($id)
    {
        try {
            $equipamento = $this->equipamento->findOrFail($id);
            return View::make('equipamentos.edit', compact('equipamento'));
        } catch(ModelNotFoundException $e) {
            return Redirect::to('equipamento')
                ->with('danger', Util::message('MSG003'));
        }
    }

    public function update($id)
    {
        $input = Input::all();
        $validator = $this->equipamento->validate($input);

        if($validator->fails()){
            return Redirect::back()
                ->withInput()
                ->withErrors($validator)
                ->with('danger', Util::message('MSG004'));
        } else {
            
            //Altera os valores das flags
            $input['ativo'] = (Input::has('ativo') ? true : false );

            //Altera o formato das datas
            if(Input::has('data_cadastro')) {
                $input['data_cadastro'] = Util::toMySQL(Input::get('data_cadastro'));
            }

            if(Input::has('data_fabricacao')) {
                $input['data_fabricacao'] = Util::toMySQL(Input::get('data_fabricacao'));
            }

            $this->equipamento->find($id)->update($input);

            return Redirect::to('equipamento')
                ->with('success', Util::message('MSG005'));
        }
    }

    public function destroy($id)
    {
        try {
            $this->equipamento->find($id)->delete();
            return Redirect::to('equipamento')
                ->with('success', Util::message('MSG006'));
        } catch (Exception $e) {
            return Redirect::to('equipamento')
                ->with('warning', Util::message('MSG007'));
        }
    }

}