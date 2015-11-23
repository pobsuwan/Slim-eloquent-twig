<?php
namespace App\Controllers;
use Illuminate\Database\Capsule\Manager as Capsule;
/**
*  User Controller
*/
class UserController
{
	public function __construct()
	{
		$this->db = new Capsule;
	}

	public function getAllUsers()
	{
		return $this->db->table('users')->get();
	}

	public function getUsers($id)
	{
		return $this->db->table('users')->where('id', $id)->get();
	}
}