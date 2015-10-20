<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model as Eloquent;

/**
*  User Model
*/
class User extends Eloquent
{
	protected $table = 'users';

	protected $fillable = [
		'email',
		'username',
		'password'
	];

	public $name = 'Apiwat'; 
	
	function __construct()
	{
		# code...
	}

	public function setPasswordAttribute($value)
	{
	    $salt = 'whatever';
	    $this->attributes['password'] = md5($salt.$value);
	}
}