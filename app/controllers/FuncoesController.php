<?php

use Eloquent\Database\Eloquent\ModelNotFoundException;

class FuncoesController extends BaseController {

	protected $funcao;

	public function __construct(Funcao $funcao)
    {
        parent::__construct();
        $this->funcao = $funcao;
    }

    public function index()
    {
        $descricao = null;

        $fields = array('descricao', 'ativo', 'created_at', 'updated_at' );
        $sort = in_array(Input::get('sort'), $fields) ? Input::get('sort') : 'descricao';
        $order = Input::get('order') === 'desc' ? 'desc' : 'asc';

        $funcoes = $this->funcao->orderBy($sort, $order);

        if(Input::has('descricao')) {
            $funcoes = $funcoes->where('descricao', 'LIKE', "%". Input::get('descricao') ."%");
            $descricao = '&descricao='. Input::get('descricao');
        }   

        $funcoes = $funcoes->paginate(15);

        $pagination = $funcoes->appends(array(
            'descricao' => Input::get('descricao'),
            'sort' => Input::get('sort'),
            'order' => Input::get('order')
        ))->links();

        return View::make('funcoes.index')
            ->with(array(
                'descricao' => Input::get('descricao'),
                'funcoes' => $funcoes,
                'pagination' => $pagination,
                'str' => '&order='.(Input::get('order') == 'asc' || null ? 'desc' : 'asc') . $descricao
        ));
    }

    public function create()
    {
        return View::make('funcoes.create');
    }

    public function store()
    {
        $input = Input::all();
        $validator = $this->funcao->validate($input);

        if($validator->fails()) {
            return Redirect::back()
                ->withInput()
                ->withErrors($validator)
                ->with('danger', Util::message('MSG001'));
        } else {

            $this->funcao->create($input);

            return Redirect::to('funcao')
                ->with('success', Util::message('MSG002'));
        }
    }

    public function edit($id)
    {
        try {
            
            $funcao = $this->funcao->findOrFail($id);

            return View::make('funcoes.edit')
                ->with(array(
                    'funcao' => $funcao
                ));

        } catch(ModelNotFoundException $e) {
            return Redirect::to('funcao')
                ->with('danger', Util::message('MSG003'));
        }
    }

    public function update($id)
    {
        $input = Input::all();
        $validator = $this->funcao->validate($input);

        if($validator->fails()){
            return Redirect::back()
                ->withInput()
                ->withErrors($validator)
                ->with('danger', Util::message('MSG004'));

        } else {

             $this->funcao->find($id)->update($input);

            return Redirect::to('funcao')
                ->with('success', Util::message('MSG005'));
        }
    }

    public function destroy($id)
    {
        try { 

            $funcao = $this->funcao->find($id);

            $funcao->update(array(
                'ativo' => false
            ));

            return Redirect::to('funcao')
                ->with('success', Util::message('MSG014'));

        } catch (Exception $e) {
            return Redirect::to('funcao')
                ->with('warning', Util::message('MSG015'));
        }
    }
}