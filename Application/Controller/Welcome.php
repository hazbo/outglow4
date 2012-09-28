<?php namespace Application;

// Sample code!

class Controller_Welcome extends Foundation_Controller
{
	public function init($container, $routes)
	{
		$this->append('container', $container);
		$this->append('routes', $routes);
	}

	public function main()
	{
		echo $this->routes[0];
	}
}

?>