<?php namespace Application;

// Sample code!

class Controller_Welcome extends Foundation_Controller
{
	public function init($container, $routes)
	{
		$this->append('container', $container);
		$this->append('routes', $routes);
		$this->append('user', new Model_User($container));
	}

	public function main()
	{
		$this->needs($this->routes);
	}
}

?>