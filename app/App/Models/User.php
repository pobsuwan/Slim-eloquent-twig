<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model as Eloquent;

/**
*  User Model
*/
class User extends Eloquent
{
	public $name = 'Apiwat'; 
	
	function __construct()
	{
		# code...
	}
}