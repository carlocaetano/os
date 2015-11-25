<?php

use Eloquent\Database\Eloquent\ModelNotFoundException;

class MateriaisController extends BaseController {

	protected $material;

	public function __construct(Material $material)
    {
        parent::__construct();
        $this->material = $material;
    }

    public function index()
    {
        $descricao = $fabricante_marca = $situacao = null;

        $fields = array('descricao', 'fabricante_marca', 'situacao');
        $sort = in_array(Input::get('sort'), $fields) ? Input::get('sort') : 'descricao';
        $order = Input::get('order') === 'desc' ? 'desc' : 'asc';

        $materiais = $this->material->orderBy($sort, $order)
                             ->join('localizacao_materiais', 'materiais.localizacao_id', '=', 'localizacao_materiais.id')
                             ->join('categorias_materiais', 'materiais.categoria_id', '=', 'categorias_materiais.id');

        if(Input::has('descricao')) {
            $materiais = $materiais->where('descricao', '=', Input::get('descricao') );
            $descricao = '&descricao='. Input::get('descricao');
        }

        if(Input::has('fabricante_marca')) {
            $materiais = $materiais->where('fabricante_marca', '=', Input::get('fabricante_marca') );
            $fabricante_marca = '&fabricante_marca='. Input::get('fabricante_marca');
        }

        if(Input::has('situacao')) {
            $materiais = $materiais->where('situacao', '=', Input::get('situacao') );
            $situacao = '&situacao='. Input::get('situacao');
        }


        $materiais = $materiais->paginate(10,
            array('materiais.id',
                  'materiais.descricao',
                  'materiais.fabricante_marca',
                  'materiais.unidade',
                  'materiais.qtde',
                  'materiais.situacao',
                  'materiais.ativo',
                  'localizacao_materiais.descricao As localizacao',
                  'categorias_materiais.descricao As categoria'
                  ));

        $pagination = $materiais->appends(array(
            'descricao' => Input::get('descricao'),
            'fabricante_marca' => Input::get('fabricante_marca'),
            'situacao' => Input::get('situacao'),
            'sort' => Input::get('sort'),
            'order' => Input::get('order')
        ))->links();

        return View::make('materiais.index')
            ->with(array(
                'descricao' => Input::get('descricao'),
                'fabricante_marca' => Input::get('fabricante_marca'),
                'situacao' => Input::get('situacao'),
                'materiais' => $materiais,
                'pagination' => $pagination,
                'str' => '&order='.(Input::get('order') == 'asc' || null ? 'desc' : 'asc') . 
                $descricao . $fabricante_marca . $situacao ));
    }

    public function show($id)
    {
        try {

             $material = $this->material
                            ->where('materiais.id',$id)
                            ->join('localizacao_materiais', 'materiais.localizacao_id', '=', 'localizacao_materiais.id')
                             ->join('categorias_materiais', 'materiais.categoria_id', '=', 'categorias_materiais.id')
                            ->select('materiais.id',
                                     'materiais.descricao',
                                     'materiais.fabricante_marca',
                                     'materiais.unidade',
                                     'materiais.qtde',
                                     'materiais.data_fabricacao',
                                     'materiais.estoque_min',
                                     'materiais.estoque_max',
                                     'materiais.preco_custo',
                                     'materiais.data_cadastro',
                                     'materiais.observacao',
                                     'materiais.ativo',
                                     'materiais.situacao',
                                     'localizacao_materiais.descricao As localizacao',
                                     'categorias_materiais.descricao As categoria')->first();

            return View::make('materiais.show', compact('material'));

        } catch(ModelNotFoundException $e) {
            return Redirect::to('material')
                ->with('danger', Util::message('MSG003'));
        }
    }

    public function create()
    {
        return View::make('materiais.create');
    }

    public function store()
    {
        $input = Input::all();
        $validator = $this->material->validate($input);

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

            $this->material->create($input);

            return Redirect::to('material')
                ->with('success', Util::message('MSG002'));
        }
    }

    public function edit($id)
    {
        try {
            $material = $this->material->findOrFail($id);
            return View::make('materiais.edit', compact('material'));
        } catch(ModelNotFoundException $e) {
            return Redirect::to('material')
                ->with('danger', Util::message('MSG003'));
        }
    }

    public function update($id)
    {
        $input = Input::all();
        $validator = $this->material->validate($input);

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

            $this->material->find($id)->update($input);

            return Redirect::to('material')
                ->with('success', Util::message('MSG005'));
        }
    }

    public function destroy($id)
    {
        try {
            $this->material->find($id)->delete();
            return Redirect::to('material')
                ->with('success', Util::message('MSG006'));
        } catch (Exception $e) {
            return Redirect::to('material')
                ->with('warning', Util::message('MSG007'));
        }
    }

}