<?php

use Eloquent\Database\Eloquent\ModelNotFoundException;

class LocalizacaoMateriaisController extends BaseController {

	protected $localizacao;

	public function __construct(LocalizacaoMateriais $localizacao)
    {
        parent::__construct();
        $this->localizacao = $localizacao;
    }

    public function index()
    {
        $descricao = null;

        $fields = array('descricao', 'ativo', 'created_at', 'updated_at' );
        $sort = in_array(Input::get('sort'), $fields) ? Input::get('sort') : 'descricao';
        $order = Input::get('order') === 'desc' ? 'desc' : 'asc';

        $localizacoes = $this->localizacao->orderBy($sort, $order);

        if(Input::has('descricao')) {
            $localizacoes = $localizacoes->where('descricao', 'LIKE', "%". Input::get('descricao') ."%");
            $descricao = '&descricao='. Input::get('descricao');
        }   

        $localizacoes = $localizacoes->paginate(15);

        $pagination = $localizacoes->appends(array(
            'descricao' => Input::get('descricao'),
            'sort' => Input::get('sort'),
            'order' => Input::get('order')
        ))->links();

        return View::make('localizacao_mat.index')
            ->with(array(
                'descricao' => Input::get('descricao'),
                'localizacoes' => $localizacoes,
                'pagination' => $pagination,
                'str' => '&order='.(Input::get('order') == 'asc' || null ? 'desc' : 'asc') . $descricao
        ));
    }

    public function create()
    {
        return View::make('localizacao_mat.create');
    }

    public function store()
    {
        $input = Input::all();
        $validator = $this->localizacao->validate($input);

        if($validator->fails()) {
            return Redirect::back()
                ->withInput()
                ->withErrors($validator)
                ->with('danger', Util::message('MSG001'));
        } else {

            $this->localizacao->create($input);

            return Redirect::to('localizacao_mat')
                ->with('success', Util::message('MSG002'));
        }
    }

    public function edit($id)
    {
        try {
            
            $localizacao = $this->localizacao->findOrFail($id);

            return View::make('localizacao_mat.edit')
                ->with(array(
                    'localizacao' => $localizacao
                ));

        } catch(ModelNotFoundException $e) {
            return Redirect::to('localizacao_mat')
                ->with('danger', Util::message('MSG003'));
        }
    }

    public function update($id)
    {
        $input = Input::all();
        $validator = $this->localizacao->validate($input);

        if($validator->fails()){
            return Redirect::back()
                ->withInput()
                ->withErrors($validator)
                ->with('danger', Util::message('MSG004'));

        } else {

             $this->localizacao->find($id)->update($input);

            return Redirect::to('localizacao_mat')
                ->with('success', Util::message('MSG005'));
        }
    }

    public function destroy($id)
    {
        try { 

            $localizacao = $this->localizacao->find($id);

            $localizacao->update(array(
                'ativo' => false
            ));

            return Redirect::to('localizacao_mat')
                ->with('success', Util::message('MSG014'));

        } catch (Exception $e) {
            return Redirect::to('localizacao_mat')
                ->with('warning', Util::message('MSG015'));
        }
    }
}