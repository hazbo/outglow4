<?php namespace Application;

/**
 * OUTGLOW 4 RELEASE FRAMEWORK
 * 
 * FEEL FREE TO USE / MODIFY ANY OF THIS
 * CODE FOR YOUR OWN PROJECTS
 * OPEN SOURCE / COMMERCIAL
 *
 * @author Harry Lawrence
 * @copyright Outglow 2012
 * @package Foundation Controller
 * @version 1.0
 * @license The MIT License (MIT)
*/

class Foundation_Controller extends Foundation_Base_Core
{
	/**
	 * CREATE THE LOCAL BASE
	 * PROPERTY
	 * @var Array
	 */
	private $local = array();

	/**
	 * - append
	 * APPEND VALUES TO A LOCAL
	 * CONTROLLER PROPERTY
	 * @param String
	 * @param String
	 * @return bool
	 */
	public function append($key, $value)
	{
		return $this->local[strtolower($key)] = $value;
	}

	/**
	 * - detach
	 * UNSET VALUES FROM THE
	 * LOCAL PROPERTY
	 * @param String
	 * @return bool
	 */
	public function detach($key)
	{
		unset($this->local[$key]);
		return true;
	}

	/**
	 * - __get
	 * MAGIC METHOD TO RETURN
	 * VALUES FROM THE LOCAL
	 * PROPERTY
	 * @param String
	 * @return Object
	 */
	public function __get($key)
	{
		return $this->local[$key];
	}
}

?>