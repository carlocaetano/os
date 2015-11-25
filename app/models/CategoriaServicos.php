<?php

class CategoriaServicos extends BaseModel
{
	protected $table = 'categorias_servicos';

    protected $fillable = array('descricao', 'ativo');

	public static $rules = array(
        'descricao' => 'required|min:3|max:45|unique:categorias_materiais,descricao',
        'ativo' => 'required|in:0,1',
    );

    public static function validate($data)
	{
		if(Request::getMethod() == 'PUT') {
			$id = Request::segment(2);
			self::$rules['descricao'] .= ",$id";
			self::$rules['ativo'] .= ",$id";
		}

		return Validator::make($data, self::$rules);
	}

	public function servicos()
	{
		return $this->hasMany('Servico', 'categoria_id');
	}

	public static function options()
	{
		$result = static::orderBy('descricao')->lists('descricao', 'id');

		return array('' => 'Selecione uma categoria') + $result;
	}

}