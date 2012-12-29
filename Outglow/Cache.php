<?php

class Cache
{
	private $container;
	private $configDir;
	private $configCaches;

	public function __construct(Bootstrap $bootstrap)
	{
		if ($this->checkForMemcache()) {
			$this->container 	= $bootstrap->getContainer();
			$this->configDir 	= __DIR__ . '/../Config/';
			$this->configCaches = array(
				'General.yml',
				'Facebook.yml',
				'Memcache.yml'
			);
		}
	}

	private function checkForMemcache()
	{
		return (class_exists('Memcache'));
	}

	
}

?>