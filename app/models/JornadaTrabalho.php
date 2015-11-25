<?php

class JornadaTrabalho extends BaseModel
{
	protected $table = 'jornada_trabalho';
	public $timestamps = false;

    protected $fillable = array('hr_inicial', 'inter_hr_inicial', 'inter_hr_final', 'hr_final', 'HR_TEMPO', 'situacao');

	public static $rules = array(
        'hr_inicial' => 'required|date_format:H:i',
        'inter_hr_inicial' => 'required|date_format:H:i',
        'inter_hr_final' => 'required|date_format:H:i',
        'hr_final' => 'required|date_format:H:i',
        'HR_TEMPO' => 'required|date_format:H:i',
        'situacao' => 'required|in:0,1'
    );

    public static function validate($data)
	{
		if(Request::getMethod() == 'PUT') {
			$id = Request::segment(2);
			self::$rules['hr_inicial'] .= ",$id";
			self::$rules['inter_hr_inicial'] .= ",$id";
			self::$rules['inter_hr_final'] .= ",$id";
			self::$rules['hr_final'] .= ",$id";
			self::$rules['HR_TEMPO'] .= ",$id";
			self::$rules['situacao'] .= ",$id";
		}

		return Validator::make($data, self::$rules);
	}

	public function jornadas_func()
	{
		return $this->hasMany('Funcionario', 'jornada_id');
	}

	public static function options()
	{
		$result = static::orderBy('hr_inicial')
			->select(DB::raw('concat (TIME_FORMAT(hr_inicial,"%H:%i"), " | ", TIME_FORMAT(inter_hr_inicial,"%H:%i"), " | ", TIME_FORMAT(inter_hr_final,"%H:%i"), " | ", TIME_FORMAT(hr_final,"%H:%i")) as hr_jornada, id'))
			->lists('hr_jornada', 'id');

		return array('' => 'Selecione uma função') + $result;
	}

}