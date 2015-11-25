<?php

class Funcionario extends BaseModel
{
	protected $table = 'funcionarios';

    protected $fillable = array('nome', 'matricula', 'data_nascimento', 'data_admissao', 'data_demissao',
        'naturalidade', 'uf_natural', 'nacionalidade', 'tel_1', 'tel_2', 'celular1', 'celular2', 'rg', 'data_exped_rg', 'orgao_exp_rg', 'cpf', 'email', 'ativo',
        'endereco', 'numero', 'complemento', 'bairro', 'cidade', 'uf', 'cep', 
        'observacao', 'jornada_id', 'funcao_id');

	public static $rules = array (
        'nome' => 'required|min:5|max:180',
        'matricula' => 'required|min:4|max:8',
        'data_nascimento' => 'required|date_format:d/m/Y',
        'data_admissao' => 'required|date_format:d/m/Y',
        'data_demissao' => 'date_format:d/m/Y',
        'naturalidade' => 'required|min:3|max:150',
        'uf_natural' => 'required|min:2|max:2',
        'cpf' => 'required|max:14',
        'rg' => 'min:2|max:15',
        'data_exped_rg' => 'date_format:d/m/Y',
        'orgao_exp_rg' => 'min:2|max:8',
        'endereco' => 'required|max:255',
        'numero' => 'required|min:1|max:4',
        'bairro' => 'required|min:1|max:255',
        'cidade' => 'required|min:3|max:150',
        'uf' => 'required|min:2|max:2',
        'cep' => 'required|max:10',
        'email' => 'required|email|min:3|max:120',
        'observacao' => 'max:255',
        'jornada_id' => 'required|integer',
        'funcao_id' => 'required|integer'
    );


    public function jornada()
    {
        return $this->belongsTo('JornadaTrabalho', 'jornada_id');
    }

    public function funcao()
    {
        return $this->belongsTo('Funcao', 'funcao_id');
    }  
     
}