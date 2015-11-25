<?php

class Fornecedor extends BaseModel
{
	protected $table = 'fornecedores';

    protected $fillable = array('nome_razao_social',
                                'tp_pessoa',
                                'cpf',
                                'cnpj',
                                'apelido_nome_fantasia',
                                'inscricao_est_rg',
                                'data_exped_rg',
                                'orgao_exp_rg',
                                'endereco',
                                'numero',
                                'complemento',
                                'ponto_referencia',
                                'bairro',
                                'cidade',
                                'uf',
                                'cep',
                                'tel_1',
                                'tel_2',
                                'tel_3',
                                'celular1',
                                'celular2',
                                'email',
                                'site',
                                'observacao',
                                'data_cadastro',
                                'ativo'
                                );

	public static $rules = array (
        'nome_razao_social' => 'required|min:5|max:180',
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
}