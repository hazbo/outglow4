<?php namespace Application;

class Foundation_Controller
{
	private $local = array();

	public function __construct()
	{

	}

	public function append($key, $value)
	{
		return $this->local[strtolower($key)] = $value;
	}

	public function detach($key)
	{
		unset($this->local[$key]);
		return true;
	}

	public function needs($value)
	{
		if (isset($value)) {
			
		}
	}

	public function __get($key)
	{
		return $this->local[$key];
	}
}

?>