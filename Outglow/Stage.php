<?php

class Stage
{
	private $container;
	private $controller;
	private $action;

	private function setContainer($newContainer)
	{
		$this->container = $newContainer;
	}

	public function init(Outglow\Component\Community\Community $container)
	{
		$this->setContainer($container);
		$this->selfRoute();
		$this->parseRoutes();
		$this->callRoutes();
	}

	private function callRoutes()
	{
		$class = 'Application\Controller_' . $this->controller;
		if (class_exists($class)) {
			if (method_exists($class, $this->action)) {
				$object = new $class();
				if (method_exists($object, 'init'))
				{
					$object->init($this->container);
				}
				$method = $this->action;
				$object->$method();
			} else {
				throw new Exception('Action ' . $this->action . ' does not exist');
			}
		} else {
			throw new Exception('Controller ' . $this->controller . ' does not exist');
		}
	}

	private function parseRoutes()
	{
		$routes = $this->container->get('REQUEST');
		$this->controller = ucfirst($routes[0]);
		$this->action 	  = $routes[1];
		return true;
	}

	private function selfRoute()
	{
		$this->container->set('REQUEST', function() {
			$request = $_SERVER['REQUEST_URI'];
			if (strpos($request, '/index.php/') !== false)
			{
				$request = str_replace('/index.php/', '', $request);
			}
			return explode('/', $request);
		});
	}
}

?>