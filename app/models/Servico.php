<?php

class Servico extends BaseModel
{
	protected $table = 'servicos';
    
    protected $fillable = array(
            'descricao',
            'min_hr',
            'min_min',
            'max_hr',
            'max_min',
            'prioridade',
            'ativo',
            'categoria_id'
            );

	public static $rules = array (
        'descricao' => 'required|min:5|max:180',
        'min_hr' => 'numeric',
        'min_min' => 'numeric',
        'max_hr' => 'numeric',
        'max_min' => 'numeric',
        'prioridade' => 'min:1',
        'ativo' => 'required|integer',
        'categoria_id' => 'required|integer'      
        
    );


    public function categoria_servico()
    {
        return $this->belongsTo('CategoriaServicos', 'categoria_id');
    }


    public static function prioridade(){
        return array(
            '' => 'Selecione...',
            '0' => 'Máxima',
            '1' => 'Média',
            '2' => 'Mínima'
        );
    }

    public static function retorna_prioridade($prioridade){

         $lista =  array(
                        '1' => '0',
                        '2' => '1',
                        '3' => '2'
        );

        $se = array_search($prioridade, $lista);

         $lista2 = array(
            '1' => 'Máxima',
            '2' => 'Média',
            '3' => 'Mínima'
        );

        return $lista2[$se];

    }
     
}