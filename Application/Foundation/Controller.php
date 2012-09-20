<?php namespace Application;

class Foundation_Controller
{
	private $local = array();

	public function __construct()
	{

	}

	public function append($key, $value)
	{
		return $this->local[$key] = $value;
	}

	/**
	 * - load
	 * ALIAS METHOD FOR APPEND
	 * @param String
	 * @param Object
	 */
	public function load($key, $value)
	{
		return $this->append($key, $value);
	}

	public function detach($key)
	{
		unset($this->local[$key]);
		return true;
	}

	public function __get($key)
	{
		return $this->local[$key];
	}
}

?>