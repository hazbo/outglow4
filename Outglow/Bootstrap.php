<?php

class Bootstrap
{
	private $loader    = NULL;
	private $community = NULL;

	public function __construct(SplClassLoader $loader)
	{
		$this->loader = $loader;
	}

	public function fire(Stage $stage)
	{
		$this->loadOutglowCommunity();
		$this->injectOutglowHttpBase();
		$this->injectSymfonyYaml();

		$stage->init($this->community);

		$this->setLoader(NULL);
		$this->setCommunity(NULL);
	}

	private function setLoader($newLoader)
	{
		return $this->loader = $newLoader;
	}

	private function setCommunity($newCommunity)
	{
		return $this->community = $newCommunity;
	}

	public function loadOutglowCommunity()
	{
		$this->loader->setup('Outglow\Component\Community', __DIR__ . '/../');
		$this->community = new \Outglow\Component\Community\Community();
		return true;
	}

	public function injectOutglowHttpBase()
	{
		$this->community->set('HttpBase', function() {
			$loader = new SplClassLoader();
			$loader->setup('Outglow\Component\HttpBase', __DIR__ . '/../');
			return new \Outglow\Component\HttpBase\HttpBase();
		}, true);
		return true;
	}

	public function injectSymfonyYaml()
	{
		$this->loader->setup('Symfony\Component\Yaml' , __DIR__ . '/../Bundles/');
		$this->community->set('Yaml', function() {
			return new \Symfony\Component\Yaml\Parser();
		});
		return true;
	}
}
	
?>