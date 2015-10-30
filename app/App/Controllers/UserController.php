<?php
namespace App\Controllers;
use Illuminate\Database\Capsule\Manager as Capsule;
/**
*  User Controller
*/
class UserController
{
	function __construct()
	{
		$this->db = new Capsule;
	}

	public function getUsers($id)
	{
		return $this->db->table('users')->where('id', $id)->get();
	}
}