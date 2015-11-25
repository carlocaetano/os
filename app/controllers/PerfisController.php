<?php

use Eloquent\Database\Eloquent\ModelNotFoundException;

class PerfisController extends BaseController {

	protected $perfil;

	public function __construct(Perfil $perfil)
    {
        parent::__construct();
        $this->perfil = $perfil;
    }

    public function index()
    {
        $descricao = null;

        $fields = array('descricao', 'created_at', 'updated_at', );
        $sort = in_array(Input::get('sort'), $fields) ? Input::get('sort') : 'descricao';
        $order = Input::get('order') === 'desc' ? 'desc' : 'asc';

        $perfis = $this->perfil->orderBy($sort, $order);

        if(Input::has('perfil')) {
            $perfis = $perfis->where('descricao', 'LIKE', "%". Input::get('descricao') ."%");
            $descricao = '&descricao='. Input::get('descricao');
        }

        $perfis = $perfis->paginate(15);

        $pagination = $perfis->appends(array(
            'descricao' => Input::get('descricao'),
            'sort' => Input::get('sort'),
            'order' => Input::get('order')
        ))->links();

        return View::make('perfis.index')
            ->with(array(
                'descricao' => Input::get('descricao'),
                'perfis' => $perfis,
                'pagination' => $pagination,
                'str' => '&order='.(Input::get('order') == 'asc' || null ? 'desc' : 'asc') . $descricao
        ));
    }

    public function create()
    {
        return View::make('perfis.create');
    }

    public function store()
    {
        $input = Input::all();
        $validator = $this->perfil->validate($input);

        if($validator->fails()) {
            return Redirect::back()
                ->withInput()
                ->withErrors($validator)
                ->with('danger', Util::message('MSG001'));
        } else {
            $perfil = $this->perfil->create(array(
                'descricao' => Input::get('descricao')
            ));

            $perfil->acoes()->sync(Input::get('acoes_id'));

            return Redirect::to('perfil')
                ->with('success', Util::message('MSG002'));
        }
    }

    public function edit($id)
    {
        try {
            $acoes_id = array();
            
            $perfil = $this->perfil->findOrFail($id);

            if($perfil->acoes) {
                foreach ($perfil->acoes as $acao) {
                    $acoes_id[] = $acao->id;
                }
            }

            return View::make('perfis.edit')
                ->with(array(
                    'perfil' => $perfil,
                    'acoes_id' => $acoes_id,
                ));

        } catch(ModelNotFoundException $e) {
            return Redirect::to('perfil')
                ->with('danger', Util::message('MSG003'));
        }
    }

    public function update($id)
    {
        $input = Input::all();
        $validator = $this->perfil->validate($input);

        if($validator->fails()){
            return Redirect::back()
                ->withInput()
                ->withErrors($validator)
                ->with('danger', Util::message('MSG004'));

        } else {

            $perfil = $this->perfil->find($id);

            $perfil->update(array(
                'descricao' => Input::get('descricao')
            ));

            $perfil->acoes()->sync(Input::get('acoes_id'));

            return Redirect::to('perfil')
                ->with('success', Util::message('MSG005'));
        }
    }

    public function destroy($id)
    {
        try { 

            $acoes_id = array();

            $perfil = $this->perfil->find($id);

            foreach ($perfil->acoes as $acao) {
                $acoes_id[] = $acao_id;
            }

            $perfil->acoes()->detach($acoes_id);

            $perfil->delete();

            return Redirect::to('perfil')
                ->with('success', Util::message('MSG006'));

        } catch (Exception $e) {
            return Redirect::to('perfil')
                ->with('warning', Util::message('MSG007'));
        }
    }
}