<?php

use Eloquent\Database\Eloquent\ModelNotFoundException;

class ServicosController extends BaseController {

	protected $servico;

	public function __construct(Servico $servico)
    {
        parent::__construct();
        $this->servico = $servico;
    }

    public function index()
    {
        $descricao = $categoria_id = null;

        $fields = array('descricao', 'categoria_id');
        $sort = in_array(Input::get('sort'), $fields) ? Input::get('sort') : 'descricao';
        $order = Input::get('order') === 'desc' ? 'desc' : 'asc';

        $servicos = $this->servico->orderBy($sort, $order)
                             ->join('categorias_servicos', 'servicos.categoria_id', '=', 'categorias_servicos.id');

        if(Input::has('descricao')) {
            $servicos = $servicos->where('descricao', '=', Input::get('descricao') );
            $descricao = '&descricao='. Input::get('descricao');
        }

        if(Input::has('categoria_id')) {
            $servicos = $servicos->where('categoria_id', '=', Input::get('categoria_id') );
            $categoria_id = '&categoria_id='. Input::get('categoria_id');
        }


        $servicos = $servicos->paginate(10,
            array('servicos.id',
                  'servicos.descricao',
                  'servicos.min_hr',
                  'servicos.min_min',
                  'servicos.max_hr',
                  'servicos.max_min',
                  'servicos.prioridade',
                  'servicos.ativo',
                  'categorias_servicos.descricao As categoria'
                  ));

        $pagination = $servicos->appends(array(
            'descricao' => Input::get('descricao'),
            'categoria_id' => Input::get('categoria_id'),
            'sort' => Input::get('sort'),
            'order' => Input::get('order')
        ))->links();

        return View::make('servicos.index')
            ->with(array(
                'descricao' => Input::get('descricao'),
                'categoria_id' => Input::get('categoria_id'),
                'servicos' => $servicos,
                'pagination' => $pagination,
                'str' => '&order='.(Input::get('order') == 'asc' || null ? 'desc' : 'asc') . 
                $descricao . $categoria_id ));
    }

    public function show($id)
    {
        try {

             $servico = $this->servico
                            ->where('servicos.id',$id)
                             ->join('categorias_servicos', 'servicos.categoria_id', '=', 'categorias_servicos.id')
                            ->select('servicos.id',
                                     'servicos.descricao',
                                     'servicos.min_hr',
                                     'servicos.min_min',
                                     'servicos.max_hr',
                                     'servicos.max_min',
                                     'servicos.prioridade',
                                     'servicos.ativo',
                                     'categorias_servicos.descricao As categoria')->first();

            return View::make('servicos.show', compact('servico'));

        } catch(ModelNotFoundException $e) {
            return Redirect::to('servico')
                ->with('danger', Util::message('MSG003'));
        }
    }

    public function create()
    {
        return View::make('servicos.create');
    }

    public function store()
    {
        $input = Input::all();
        $validator = $this->servico->validate($input);

        if($validator->fails()) {
            return Redirect::back()
                ->withInput()
                ->withErrors($validator)
                ->with('danger', Util::message('MSG001'));
        } else {

            //Altera os valores das flags
            $input['ativo'] = (Input::has('ativo') ? true : false );

            $this->servico->create($input);

            return Redirect::to('servico')
                ->with('success', Util::message('MSG002'));
        }
    }

    public function edit($id)
    {
        try {
            $servico = $this->servico->findOrFail($id);
            return View::make('servicos.edit', compact('servico'));
        } catch(ModelNotFoundException $e) {
            return Redirect::to('servico')
                ->with('danger', Util::message('MSG003'));
        }
    }

    public function update($id)
    {
        $input = Input::all();
        $validator = $this->servico->validate($input);

        if($validator->fails()){
            return Redirect::back()
                ->withInput()
                ->withErrors($validator)
                ->with('danger', Util::message('MSG004'));
        } else {
            
            //Altera os valores das flags
            $input['ativo'] = (Input::has('ativo') ? true : false );

            $this->servico->find($id)->update($input);

            return Redirect::to('servico')
                ->with('success', Util::message('MSG005'));
        }
    }

    public function destroy($id)
    {
        try {
            $this->servico->find($id)->delete();
            return Redirect::to('servico')
                ->with('success', Util::message('MSG006'));
        } catch (Exception $e) {
            return Redirect::to('servico')
                ->with('warning', Util::message('MSG007'));
        }
    }

}