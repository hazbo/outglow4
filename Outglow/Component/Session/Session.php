<?php namespace Outglow\Component\Session;

/**
 * A SMALL SET OF FILES TO HELP HANDLE
 * SESSIONS
 * 
 * FEEL FREE TO USE / MODIFY ANY OF THIS
 * CODE FOR YOUR OWN PROJECTS
 * OPEN SOURCE / COMMERCIAL
 *
 * @author Harry Lawrence
 * @copyright Outglow Components 2012
 * @package Session
 * @version 1.0
 * @license The MIT License (MIT)
*/

class Session
{
	/**
	 * - constructor
	 * DOES NOTHING YET
	 * @return NULL
	 */
	public function __construct()
	{

	}

	/**
	 * - set
	 * SETS A VALUE IN THE
	 * SESSION USING THE KEY
	 * AND VALUE PARAMS
	 * @param String
	 * @param String
	 * @return bool
	 */
	public function set($key, $value)
	{
		return $_SESSION[$key] = $value;
	}

	/**
	 * - get
	 * GETS THE VALUE OF THE KEY
	 * OUT OF THE CONTAINER
	 * @param String
	 * @return bool
	 */
	public function get($key)
	{
		if (isset($_SESSION[$key])) {
			return $_SESSION[$key];
		}
		return false;
	}
}

?>