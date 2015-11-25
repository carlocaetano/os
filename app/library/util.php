<?php

class Util {

	public static function message($string) {
		$json = json_decode(file_get_contents(public_path() . '/message.json'));
		return $json->$string;
	}

	public static function toView($value) {
		return ($value == '0000-00-00') ? null : date('d/m/Y', strtotime($value));
	}

	public static function hora_toView($value) {
		return date('H:i', strtotime($value));
	}

	public static function toTimestamps($value) {
		return date('d/m/Y - H:i:s', strtotime($value));
	}

	public static function toMySQL($value) {
		$date = explode('/', $value);
		return $date[2] . '-' . $date[1] . '-' . $date[0];
	}

	 public static function hora_toMySQL($value) {
	 	return date('H:i', strtotime($value));
	 }

	public static function truncate($string, $height) {
		return current(explode('\n', wordwrap($string, $height, ' ...\n')));
	}

	public static function number($value, $decimal) {
		return number_format($value, $decimal, ',', '.');
	}

	public static function estados() {
		return array(
    		'' => 'Selecione...',
			'AC' => 'Acre',
			'AL' => 'Alagoas',
			'AP' => 'Amapá',
			'AM' => 'Amazonas',
			'BA' => 'Bahia',
			'CE' => 'Ceará',
			'DF' => 'Distrito Federal',
			'GO' => 'Goiás',
			'ES' => 'Espírito Santo',
			'MA' => 'Maranhão',
			'MT' => 'Mato Grosso',
			'MS' => 'Mato Grosso do Sul',
			'MG' => 'Minas Gerais',
			'PA' => 'Pará',
			'PB' => 'Paraiba',
			'PR' => 'Paraná',
			'PE' => 'Pernambuco',
			'PI' => 'Piauí',
			'RJ' => 'Rio de Janeiro',
			'RN' => 'Rio Grande do Norte',
			'RS' => 'Rio Grande do Sul',
			'RO' => 'Rondônia',
			'RR' => 'Roraima',
			'SP' => 'São Paulo',
			'SC' => 'Santa Catarina',
			'SE' => 'Sergipe',
			'TO' => 'Tocantins',
		);
	}

	public static function limpa_string($string) {

		if ($string != "") {
			$newstring = str_replace(" ", "", $string);
			$newstring = str_replace(".", "", $newstring);
			$newstring = str_replace(",", "", $newstring);
			$newstring = str_replace("-", "", $newstring);
			$newstring = str_replace("/", "", $newstring);
			$newstring = str_replace("(", "", $newstring);
			$newstring = str_replace(")", "", $newstring);	
		} else {
			$newstring = null;
		}
		
		return $newstring;
	}


	public static function mascara_string($mascara, $string) {
	   
	   $string = str_replace(" ","",$string);
	   
	   for($i=0;$i<strlen($string);$i++)
	   {
	      $mascara[strpos($mascara,"#")] = $string[$i];
	   }
   	   return $mascara;
	}

	public static function mask($val, $mask) {

		$maskared = '';
		$k = 0;
		
		if($val != "") {

			for($i = 0; $i<=strlen($mask)-1; $i++)
			{
				if($mask[$i] == '#') {
					if(isset($val[$k]))
						$maskared .= $val[$k++];
				}else {
					if(isset($mask[$i]))
						$maskared .= $mask[$i];
				}
			}
			
		}

		return ($maskared != '') ? $maskared : null;
	}

}