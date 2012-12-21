<?php namespace Outglow\Component\Memcache;

class Memcache
{
	private $memcacheObject;
	private $host = NULL;
	private $port = NULL;

	public function __construct(\Memcache $newMemcacheObject)
	{
		$this->memcacheObject = new $newMemcacheObject;
	}

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

	public function setMemcacheObject($newMemcacheObject)
	{
		return $this->memcacheObject = $newMemcacheObject;
	}

	public function setHost($newHost)
	{
		return $this->host = $newHost;
	}

	public function setPort($newPort)
	{
		return $this->port = $newPort;
	}

	public function getHost()
	{
		return $this->host;
	}

	public function getPort()
	{
		return $this->port;
	}

	public function getMemcacheObject()
	{
		return $this->memcacheObject;
	}

	public function connect()
	{
		return $this->memcacheObject->connect($this->host, $this->port);
	}

	public function set($key, $value, $compress = false, $timeout = 0)
	{
		return $this->memcacheObject->set($key, $value, $compress, $timeout);
	}

	public function get($key)
	{
		return $this->memcacheObject->get($key);
	}
}

?>