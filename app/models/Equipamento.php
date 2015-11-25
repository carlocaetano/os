<?php

class Equipamento extends BaseModel
{
	protected $table = 'equipamentos';
    public $timestamps = false;
    
    protected $fillable = array(
            'descricao',
            'modelo',
            'fabricante',
            'ativo',
            'data_fabricacao',
            'nr_patrimonio',
            'peso_kg',
            'situacao',
            'categoria_id',
            'localizacao_id',
            'cliente_id',
            'data_cadastro',
            'observacao',
            );

	public static $rules = array (
        'descricao' => 'required|min:5|max:180',
        'fabricante' => 'required|max:80',
        'modelo' => 'required|max:80',
        'data_fabricacao' => 'date_format:d/m/Y',
        'peso_kg' => 'numeric',
        'nr_patrimonio' => 'max:9',
        'data_cadastro' => 'date_format:d/m/Y',
        
        'categoria_id' => 'required|integer',
        'localizacao_id' => 'required|integer',
        'cliente_id' => 'required|integer',
        
        'situacao' => 'required|max:1',
        'ativo' => 'required|integer'
    );


    public function categoria_equip()
    {
        return $this->belongsTo('CategoriaEquipamentos', 'categoria_id');
    }

    public function localizacao_equip()
    {
        return $this->belongsTo('LocalizacaoEquipamentos', 'localizacao_id');
    }

    public function cliente()
    {
        return $this->belongsTo('Cliente', 'cliente_id');
    }


    public static function situacao_equip(){
        return array(
            '' => 'Selecione...',
            'M' => 'Em manutenção',
            'C' => 'No cliente',
            'P' => 'Aguardando peça',
            'D' => 'Defeito',
            'R' => 'Sem recuperação',
            'E' => 'Devolvido',
            'T' => 'Em Transporte',
            'G' => 'Galpão',
        );
    }

    public static function retorna_situacao_equip( $situacao ){
        

        $sit_equip =  array('1' => 'M',
                            '2' => 'C',
                            '3' => 'P',
                            '4' => 'D',
                            '5' => 'R',
                            '6' => 'E',
                            '7' => 'T',
                            '8' => 'G',
                        );

        $se = array_search($situacao, $sit_equip);

        $sit_dsc_equip = array(
            '1' => 'Em manutenção',
            '2' => 'No cliente',
            '3' => 'Aguardando peça',
            '4' => 'Defeito',
            '5' => 'Sem recuperação',
            '6' => 'Devolvido',
            '7' => 'Em Transporte',
            '8' => 'Galpão',
        );

        return $sit_dsc_equip[$se];
    }
     
}