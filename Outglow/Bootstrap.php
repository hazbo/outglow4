<?php

class Bootstrap
{
	private $container = NULL;

	public function __construct()
	{
		// Load in our container first
		$this->setContainer($this->loadOutglowCommunity());

		// Load in the rest of our dependencies
		$this->loadOutglowHttpBase();
		$this->loadSymfonyYaml();

		$this->loadApplication();
	}

	private function loadApplication()
	{
		$loader = new Loader('Application', __DIR__ . '/../');
		$loader->register();
	}

	private function setContainer($newContainer)
	{
		$this->container = $newContainer;
	}

	public function fire(Stage $stage)
	{
		$stage->init($this->container);
	}

	private function loadOutglowCommunity()
	{
		$loader = new Loader('Outglow\Component\Community', __DIR__ . '/../');
		$loader->register();
		return new Outglow\Component\Community\Community();
	}

	private function loadOutglowHttpBase()
	{
		$loader = new Loader('Outglow\Component\HttpBase', __DIR__ . '/../');
		$loader->register();
		return $this->container->set('HttpBase', function() {
			return new Outglow\Component\HttpBase\HttpBase();
		});
	}

	private function loadSymfonyYaml()
	{
		$loader = new Loader('Symfony\Component\Yaml' , __DIR__ . '/../Bundles/');
		$loader->register();
		return $this->container->set('Yaml', function() {
			return new Symfony\Component\Yaml\Parser();
		});
	}
}
	
?>