<?php

class Acao extends BaseModel
{
	protected $table = 'acoes';

    protected $fillable = array('nome', 'metodo');

	public static $rules = array(
        'nome' => 'required|max:150',
        'metodo' => 'required|max:200',
    );

    public function perfis()
	{
		return $this->belongsToMany('Perfil', 'acoes_perfis', 'acao_id', 'perfil_id');
	}

	public static function options()
	{
		return static::orderBy('id')->lists('nome', 'id');
	}

}