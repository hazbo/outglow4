<?php namespace Outglow\Component\HttpBase;

/**
 * SIMPLE SET OF FILES THAT ALLOW
 * YOU TO DEAL WITH HTTP REQUESTS
 * ELEGANTLY
 * 
 * FEEL FREE TO USE / MODIFY ANY OF THIS
 * CODE FOR YOUR OWN PROJECTS
 * OPEN SOURCE / COMMERCIAL
 *
 * @author Harry Lawrence
 * @copyright Outglow Components 2012
 * @package HttpBase
 * @version 1.0
 * @license The MIT License (MIT)
*/

class HttpBase
{
	public $query = NULL;
	public $make  = NULL;

	public function __construct()
	{
		$this->setQuery();
		$this->setMake();
	}

	private function setQuery()
	{
		return $this->query = new Query();
	}

	private function setMake()
	{
		return $this->make = new Make();
	}

	private function getQuery()
	{
		return $this->query;
	}

	private function getMake()
	{
		return $this->make;
	}
}

?>