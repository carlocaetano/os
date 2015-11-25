<?php

use Eloquent\Database\Eloquent\ModelNotFoundException;

class JornadaTrabalhoController extends BaseController {

	protected $jornada;

	public function __construct(JornadaTrabalho $jornada)
    {
        parent::__construct();
        $this->jornada = $jornada;
    }

    public function index()
    {
        $hr_inicial = $inter_hr_inicial = $inter_hr_final = $hr_final = $HR_TEMPO = $situacao = null;

        $fields = array('hr_inicial', 'inter_hr_inicial', 'inter_hr_final', 'hr_final', 'HR_TEMPO', 'situacao' );
        $sort = in_array(Input::get('sort'), $fields) ? Input::get('sort') : 'hr_inicial';
        $order = Input::get('order') === 'desc' ? 'desc' : 'asc';

        $jornadas = $this->jornada->orderBy($sort, $order);

        
        if(Input::has('hr_inicial')) {
            $jornadas = $jornadas->where('hr_inicial', '=', Input::get('hr_inicial') );
            $hr_inicial = '&hr_inicial='. Input::get('hr_inicial');
        }


        if(Input::has('HR_TEMPO')) {
            $jornadas = $jornadas->where('HR_TEMPO', '=', Input::get('HR_TEMPO') );
            $HR_TEMPO = '&HR_TEMPO='. Input::get('HR_TEMPO');
        }

        $jornadas = $jornadas->paginate(15);

        $pagination = $jornadas->appends(array(
            'hr_inicial' => Input::get('hr_inicial'),
            'HR_TEMPO' => Input::get('HR_TEMPO'),
            'sort' => Input::get('sort'),
            'order' => Input::get('order')
        ))->links();

        return View::make('jornadas.index')
            ->with(array(
                'hr_inicial' => Input::get('hr_inicial'),
                'HR_TEMPO' => Input::get('HR_TEMPO'),
                'jornadas' => $jornadas,
                'pagination' => $pagination,
                'str' => '&order='.(Input::get('order') == 'asc' || null ? 'desc' : 'asc') . $hr_inicial
        ));
    }

    public function create()
    {
        return View::make('jornadas.create');
    }

    public function store()
    {
        $input = Input::all();

        $validator = $this->jornada->validate($input);

        if($validator->fails()) {
            return Redirect::back()
                ->withInput()
                ->withErrors($validator)
                ->with('danger', Util::message('MSG001'));
        } else {

            //Altera o formato das datas
            $input['hr_inicial'] = Util::hora_toMySQL(Input::get('hr_inicial'));
            $input['inter_hr_inicial'] = Util::hora_toMySQL(Input::get('inter_hr_inicial'));
            $input['inter_hr_final'] = Util::hora_toMySQL(Input::get('inter_hr_final'));
            $input['hr_final'] = Util::hora_toMySQL(Input::get('hr_final'));
            $input['HR_TEMPO'] = Util::hora_toMySQL(Input::get('HR_TEMPO'));

            //Altera os valores das flags
            $input['situacao'] = (Input::has('situacao') ? true : false );

            $this->jornada->create($input);

             return Redirect::to('jornada')
                 ->with('success', Util::message('MSG002'));
        }
    }

    public function edit($id)
    {
        try {
            
            $jornada = $this->jornada->findOrFail($id);

            return View::make('jornadas.edit')
                ->with(array(
                    'jornada' => $jornada
                ));

        } catch(ModelNotFoundException $e) {
            return Redirect::to('jornada')
                ->with('danger', Util::message('MSG003'));
        }
    }

    public function update($id)
    {
        $input = Input::all();
        $validator = $this->jornada->validate($input);

        if($validator->fails()){
            return Redirect::back()
                ->withInput()
                ->withErrors($validator)
                ->with('danger', Util::message('MSG004'));

        } else {

             $this->jornada->find($id)->update($input);

            return Redirect::to('jornada')
                ->with('success', Util::message('MSG005'));
        }
    }

    public function destroy($id)
    {
       try {
            $this->jornada->find($id)->delete();

            return Redirect::to('jornada')
                ->with('success', Util::message('MSG006'));

        } catch (Exception $e) {
            return Redirect::to('jornada')
                ->with('warning', Util::message('MSG007'));
        }
    }
}