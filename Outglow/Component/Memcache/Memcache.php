<?php namespace Outglow\Component\Memcache;

/**
 * A SIMPLE AND SMALL WRAPPER FOR
 * MEMCACHE TO FIT NICELY WITH
 * OUTGLOW
 * 
 * FEEL FREE TO USE / MODIFY ANY OF THIS
 * CODE FOR YOUR OWN PROJECTS
 * OPEN SOURCE / COMMERCIAL
 *
 * @author Harry Lawrence
 * @copyright Outglow Components 2012
 * @package Memcache
 * @version 1.0
 * @license The MIT License (MIT)
*/

class Memcache
{

	/**
	 * CREATE THREE PROPERTIES TO STORE
	 * THE SETTINGS AND OBJECT
	 * @var Object
	 * @var NULL
	 * @var NULL
	*/
	private $memcacheObject;
	private $host = NULL;
	private $port = NULL;

	/**
	 * - constructor
	 * PASSES THE MEMCACHE OBJECT INTO
	 * THE COMPONENT
	 * @return NULL
	 */
	public function __construct(\Memcache $newMemcacheObject)
	{
		$this->memcacheObject = new $newMemcacheObject;
	}

	/**
	 * - setCheckConnect
	 * USED TO AUTOMATICLY
	 * CONNECT TO MEMCACHE WHEN
	 * POSSIBLE
	 * @param bool
	 * @return bool
	 */
	public function setCheckConnect($valid = false)
	{
		if ($valid) {
			if (!is_null($this->host) && !is_null($this->port)) {
				return $this->connect();
			}
			return false;
		}
		return false;
	}

	/**
	 * - setMemcacheObject
	 * SETS THE INTERNAL PROPERTY TO
	 * AN OBJECT CLASS OF MEMCACHE
	 * @param Object
	 * @return bool
	 */
	public function setMemcacheObject($newMemcacheObject)
	{
		return $this->memcacheObject = $newMemcacheObject;
	}

	/**
	 * - setHost
	 * SETS THE HOST PROPERTY
	 * @param String
	 * @return bool
	 */
	public function setHost($newHost)
	{
		return $this->host = $newHost;
	}

	/**
	 * - setPort
	 * SETS THE PORT PROPERTY
	 * @param int
	 * @return bool
	 */
	public function setPort($newPort)
	{
		return $this->port = $newPort;
	}

	/**
	 * - getHost
	 * GETS THE HOST PROPERTY
	 * @return String
	 */
	public function getHost()
	{
		return $this->host;
	}

	/**
	 * - getPort
	 * GETS THE POST PROPERTY
	 * @return int
	 */
	public function getPort()
	{
		return $this->port;
	}

	/**
	 * - getMemcacheObject
	 * GETS THE MEMCACHE PROPERTY
	 * @return Object
	 */
	public function getMemcacheObject()
	{
		return $this->memcacheObject;
	}

	/**
	 * - connect
	 * CALLS THE MEMCACHE CONNECT
	 * METHOD
	 * @return bool
	 */
	public function connect()
	{
		return $this->memcacheObject->connect($this->host, $this->port);
	}

	/**
	 * - set
	 * CALLS THE MEMCACHE SET
	 * METHOD
	 * @param String
	 * @param String
	 * @param bool
	 * @param int
	 * @return bool
	 */
	public function set($key, $value, $compress = false, $timeout = 0)
	{
		return $this->memcacheObject->set($key, $value, $compress, $timeout);
	}

	/**
	 * - set
	 * CALLS THE MEMCACHE GET
	 * METHOD
	 * @param String
	 * @return String
	 */
	public function get($key)
	{
		return $this->memcacheObject->get($key);
	}
}

?>