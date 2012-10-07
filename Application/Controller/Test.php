<?php namespace Application;

class Controller_Test extends Foundation_Controller
{
	private $container;

	public function init($container)
	{
		$this->container = $container;
		$this->append('Config', $this->container->get('Config'));
	}

	public function harry()
	{
		echo $this->config['general']['AGE'];
	}
}

?>