<?php

class Stage
{
	private $container;
	private $parser;
	private $router;

	public function init(Outglow\Component\Community\Community $community)
	{
		// Set the community object up
		$this->setContainer($community);

		// Set the parser up ready for use
		$this->setParser();

		// Define our settings for use within the app
		$this->applySettings();

		var_dump(NAME);
	}

	private function setContainer($newContainer)
	{
		return $this->container = $newContainer;
	}

	private function setParser()
	{
		return $this->parser = $this->getContainer()->get('Yaml');
	}

	private function setRouter($newRouter)
	{
		return $this->router = $newRouter;
	}

	private function getContainer()
	{
		return $this->container;
	}

	private function getParser()
	{
		return $this->parser;
	}

	private function getRouter()
	{
		return $this->router;
	}

	private function checkForArray($potential)
	{
		if (is_array($potential))
		{
			return json_encode($potential);
		}
		return $potential;
	}

	private function applySettings()
	{
		$general = $this->getParser()->parse(file_get_contents(__DIR__ . '/../Config/General.yml'));
		foreach ($general as $key => $value)
		{
			define($key, $this->checkForArray($value));
		}
		return true;
	}
}

?>