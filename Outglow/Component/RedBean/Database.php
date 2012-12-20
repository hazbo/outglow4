<?php namespace Outglow\Component\RedBean;

/**
 * REQUIRE THE RED BEAN CLASS
 */
require_once(__DIR__ . '/Assets/Redbean.php');

class Database
{
	public function __construct()
	{

	}
//4568
	public function setup($host = 'localhost', $port = 3306, $user = 'root', $pass = '', $name = 'test')
	{
		R::setup('mysql:host=' . $host . ';port=' . $port . ';dbname=' . $name, $user, $pass);
	}

	public function dispense($table)
	{
		return R::dispense($table);
	}

	public function find($table, $conditions)
	{
		return R::find($table, $conditions);
	}

	public function findone($table, $conditions)
	{
		return R::findone($table, $conditions);
	}
}

?>