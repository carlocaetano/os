<?php

class Cliente extends BaseModel
{
	protected $table = 'clientes';

    protected $fillable = array('razao_social', 'data_cadastro', 'nome_fantasia', 'tp_pessoa','ativo',
        'cnpj', 'cpf', 'inscricao_est_rg', 'data_exped_rg', 'orgao_exp_rg', 'data_nascimento', 'endereco',
        'numero', 'complemento', 'bairro', 'cidade', 'uf', 'cep', 'ponto_referencia',
        'tel_1', 'tel_2', 'tel_3', 'celular1', 'celular2', 'email', 'observacao');

	public static $rules = array (
        'razao_social' => 'required|min:5|max:180',
        'data_cadastro' => 'required|date_format:d/m/Y',
        'tp_pessoa' => 'required|max:1',
        'cnpj' => 'max:18',
        'cpf' => 'max:14',
        'inscricao_est_rg' => 'required|min:7|max:20',
        'endereco' => 'required|max:255',
        'numero' => 'required|min:1|max:4',
        'bairro' => 'required|min:1|max:255',
        'cidade' => 'required|min:3|max:150',
        'uf' => 'required|min:2|max:2',
        'cep' => 'required|max:10',
        'email' => 'required|email|min:3|max:120'
    );

    public function equipamentos()
    {
        return $this->hasMany('Equipamento', 'cliente_id');
    }

    public static function options()
    {
        $result = static::orderBy('razao_social')->lists('razao_social', 'id');

        return array('' => 'Selecione um cliente') + $result;
    }
}