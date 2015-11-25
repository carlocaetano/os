<?php

use Eloquent\Database\Eloquent\ModelNotFoundException;

class CategoriaMateriaisController extends BaseController {

	protected $categoria;

	public function __construct(CategoriaMateriais $categoria)
    {
        parent::__construct(); 
        $this->categoria = $categoria;
    }

    public function index()
    {
        $descricao = null;

        $fields = array('descricao', 'ativo', 'created_at', 'updated_at' );
        $sort = in_array(Input::get('sort'), $fields) ? Input::get('sort') : 'descricao';
        $order = Input::get('order') === 'desc' ? 'desc' : 'asc';

        $categorias = $this->categoria->orderBy($sort, $order);

        if(Input::has('descricao')) {
            $categorias = $categorias->where('descricao', 'LIKE', "%". Input::get('descricao') ."%");
            $descricao = '&descricao='. Input::get('descricao');
        }   

        $categorias = $categorias->paginate(15);

        $pagination = $categorias->appends(array(
            'descricao' => Input::get('descricao'),
            'sort' => Input::get('sort'),
            'order' => Input::get('order')
        ))->links();

        return View::make('categorias_mat.index')
            ->with(array(
                'descricao' => Input::get('descricao'),
                'categorias' => $categorias,
                'pagination' => $pagination,
                'str' => '&order='.(Input::get('order') == 'asc' || null ? 'desc' : 'asc') . $descricao
        ));
    }

    public function create()
    {
        return View::make('categorias_mat.create');
    }

    public function store()
    {
        $input = Input::all();
        $validator = $this->categoria->validate($input);

        if($validator->fails()) {
            return Redirect::back()
                ->withInput()
                ->withErrors($validator)
                ->with('danger', Util::message('MSG001'));
        } else {

            $this->categoria->create($input);

            return Redirect::to('categorias_mat')
                ->with('success', Util::message('MSG002'));
        }
    }

    public function edit($id)
    {
        try {
            
            $categoria = $this->categoria->findOrFail($id);

            return View::make('categorias_mat.edit')
                ->with(array(
                    'categoria' => $categoria
                ));

        } catch(ModelNotFoundException $e) {
            return Redirect::to('categorias_mat')
                ->with('danger', Util::message('MSG003'));
        }
    }

    public function update($id)
    {
        $input = Input::all();
        $validator = $this->categoria->validate($input);

        if($validator->fails()){
            return Redirect::back()
                ->withInput()
                ->withErrors($validator)
                ->with('danger', Util::message('MSG004'));

        } else {

             $this->categoria->find($id)->update($input);

            return Redirect::to('categorias_mat')
                ->with('success', Util::message('MSG005'));
        }
    }

    public function destroy($id)
    {
        try { 

            $categoria = $this->categoria->find($id);

            $categoria->update(array(
                'ativo' => false
            ));

            return Redirect::to('categorias_mat')
                ->with('success', Util::message('MSG014'));

        } catch (Exception $e) {
            return Redirect::to('categorias_mat')
                ->with('warning', Util::message('MSG015'));
        }
    }
}