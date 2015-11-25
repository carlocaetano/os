<?php

class Material extends BaseModel
{
	protected $table = 'materiais';
    public $timestamps = false;
    
    protected $fillable = array(
            'descricao',
            'fabricante_marca',
            'unidade',
            'qtde',
            'peso_kg',
            'data_fabricacao',
            'estoque_min',
            'estoque_max',
            'preco_custo',
            'data_cadastro',
            'observacao',
            'ativo',
            'situacao',
            'categoria_id',
            'localizacao_id'
            );

	public static $rules = array (
        'descricao' => 'required|min:5|max:180',
        'fabricante_marca' => 'required|max:80',
        'qtde' => 'numeric|min:1',
        'data_fabricacao' => 'date_format:d/m/Y',
        'peso_kg' => 'numeric',
        'preco_custo' => 'numeric|min:1',
        'data_cadastro' => 'date_format:d/m/Y',
        
        'categoria_id' => 'required|integer',
        'localizacao_id' => 'required|integer',
        
        'ativo' => 'required|integer'
    );


    public function categoria_equip()
    {
        return $this->belongsTo('CategoriaMateriais', 'categoria_id');
    }

    public function localizacao_equip()
    {
        return $this->belongsTo('LocalizacaoMateriais', 'localizacao_id');
    }


    public static function unidade_mat(){
        return array(
            '' => 'Selecione...',
            'KG' => 'KILOGRAMA',
            'UN' => 'UNIDADE',
            'LT' => 'LITRO',
            'MT' => 'METRO LINEAR',
            'M2' => 'METRO QUADRADO',
            'M3' => 'METRO CUBICO',
            'CX' => 'CAIXA',
            'ML' => 'MILILITRO',
            'FD' => 'FARDO',
            'PTE' => 'PACOTE',
            'HR' => 'HORA',
            'G' => 'GRAMA',
            'PR' => 'PAR',
            'KW' => 'KILOWATT'

        );
    }

    public static function retorna_unidade_mat($unidade){

         $medidas =  array(
                        '1' => 'KG',
                        '2' => 'UN',
                        '3' => 'LT',
                        '4' => 'MT',
                        '5' => 'M2',
                        '6' => 'M3',
                        '7' => 'CX',
                        '8' => 'ML',
                        '9' => 'FD',
                        '10' => 'PTE',
                        '11' => 'HR',
                        '12' => 'G',
                        '13' => 'PR',
                        '14' => 'KW'
        );

        $se = array_search($unidade, $medidas);


         $unid_mat = array(
            '1' => 'KILOGRAMA',
            '2' => 'UNIDADE',
            '3' => 'LITRO',
            '4' => 'METRO',
            '5' => 'METRO QUADRADO',
            '6' => 'METRO CUBICO',
            '7' => 'CAIXA',
            '8' => 'MILILITRO',
            '9' => 'FARDO',
            '10' => 'PACOTE',
            '11' => 'HORA',
            '12' => 'GRAMA',
            '13' => 'PAR',
            '14' => 'KILOWATT',
        );

        return $unid_mat[$se];

    }

    public static function situacao_mat(){
        return array(
            '' => 'Selecione...',
            'E' => 'Em estoque',
            'F' => 'Em Falta',
            'O' => 'No Fornecedor',
            'S' => 'Em solicitação'
        );
    }


    public static function retorna_situacao_mat( $situacao ){
        

        $sit_mat =  array('1' => 'E',
                            '2' => 'F',
                            '3' => 'O',
                            '4' => 'S'
                        );

        $se = array_search($situacao, $sit_mat);

        $sit_dsc_mat = array(
            '1' => 'Em Estoque',
            '2' => 'Em Falta',
            '3' => 'No Fornecedor',
            '4' => 'Em Solicitação'
        );

        return $sit_dsc_mat[$se];
    }
     
}