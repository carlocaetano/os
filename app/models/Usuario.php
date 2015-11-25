<?php

use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableInterface;

class Usuario extends BaseModel implements UserInterface, RemindableInterface
{
	protected $table = 'usuarios';

	protected $fillable = array('nome', 'username', 'password', 'email', 'ativo', 'perfil_id');

	public static $rules = array(
		'nome' => 'required|min:3|max:120',
		'username' => 'required|min:3|max:25|unique:usuarios,username',
		'password' => 'min:3|max:80',
		'email' => 'required|email|min:3|max:120|unique:usuarios,email',
		'ativo' => 'required|in:0,1',
		'perfil_id' => 'required|integer',
    );

    public static function validate($data)
	{
		if(Request::getMethod() == 'PUT') {
			$id = Request::segment(2);
			self::$rules['username'] .= ",$id";
			self::$rules['email'] .= ",$id";

		}

		return Validator::make($data, self::$rules);
	}

    public function perfil()
	{
		return $this->belongsTo('Perfil', 'perfil_id');
	}

	public function getAuthIdentifier()
	{
		return $this->getKey();
	}

	public function getAuthPassword()
	{
		return $this->password;
	}

	public function getReminderEmail()
	{
		return $this->email;
	}

	public function getRememberToken(){

	}

	public function setRememberToken() {

	}

}