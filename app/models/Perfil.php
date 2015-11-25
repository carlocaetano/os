<?php

class Perfil extends BaseModel
{
	protected $table = 'perfis';

    protected $fillable = array('descricao');

	public static $rules = array(
        'descricao' => 'required|min:3|max:45|unique:perfis,descricao',
        'acoes_id' => 'required|array',
    );

    public static function validate($data)
	{
		if(Request::getMethod() == 'PUT') {
			$id = Request::segment(2);
			self::$rules['descricao'] .= ",$id";
		}

		return Validator::make($data, self::$rules);
	}

    public function acoes()
	{
		return $this->belongsToMany('Acao', 'acoes_perfis', 'perfil_id', 'acao_id');
	}

	public function usuarios()
	{
		return $this->hasMany('Usuario', 'perfil_id');
	}

	public static function options()
	{
		$result = static::orderBy('descricao')->lists('descricao', 'id');

		if(Auth::user()->perfil_id != 1) {
    		unset($result[1]);
    	}
		
		return array('' => 'Selecione uma opção') + $result;
	}

}