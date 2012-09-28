<?php

/**
 * OUTGLOW 4 RELEASE FRAMEWORK
 * 
 * FEEL FREE TO USE / MODIFY ANY OF THIS
 * CODE FOR YOUR OWN PROJECTS
 * OPEN SOURCE / COMMERCIAL
 *
 * @author Harry Lawrence
 * @copyright Outglow 2012
 * @package Autorouter
 * @version 1.0
 * @license The MIT License (MIT)
*/

class Autorouter
{
	/**
	 * CREATE A CONTAINER, CONTROLLER AND
	 * ACTION PROPERTY
	 * @var Object
	 * @var String
	 * @var String
	 */
	private $container;
	private $controller;
	private $action;
	private $extra;

	/**
	 * - setContainer
	 * SETS CONTAINER PROPERTY TO
	 * OUR COMMUNITY OBJECT
	 * @param Object
	 * @return bool
	 */
	private function setContainer($newContainer)
	{
		return $this->container = $newContainer;
	}

	/**
	 * - callRoutes
	 * CREATES THE DYNAMIC OBJECTS FOR
	 * AUTOROUTING AND CALLS THE
	 * DYNAMIC METHODS
	 * @return bool
	 */
	private function callRoutes()
	{
		$class = 'Application\Controller_' . $this->controller;
		if (class_exists($class)) {
			if (method_exists($class, $this->action)) {
				$object = new $class();
				if (method_exists($object, 'init')) {
					$object->init($this->container, $this->extra);
				}
				$method = $this->action;
				$object->$method();
			} else {
				throw new Exception('Action ' . $this->action . ' does not exist');
			}
		} else {
			throw new Exception('Controller ' . $this->controller . ' does not exist');
		}
		return true;
	}

	/**
	 * -parseRoutes
	 * PARSES OUT THE DATA WE COLLECT
	 * FROM THE INITIAL ROUTES
	 * @return bool
	 */
	private function parseRoutes()
	{
		$routes = $this->container->get('REQUEST');
		$this->controller = ucfirst($routes[0]);
		$this->action 	  = $routes[1];
		unset($routes[0]);
		unset($routes[1]);
		$routes = array_merge($routes);

		$this->extra = ($routes);
		return true;
	}

	/**
	 * - selfRoute
	 * CLEANS UP WHAT WE GET FROM
	 * THE INITIAL ROUTE
	 * @return Array
	 */
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

	/**
	 * - init
	 * CALLS ALL METHODS WITHIN THIS
	 * CLASS TO CONFIGURE THE
	 * AUTOROUTING
	 * @param Object
	 * @return NULL
	 */
	public function init(Outglow\Component\Community\Community $container)
	{
		$this->setContainer($container);
		$this->selfRoute();
		$this->parseRoutes();
		$this->callRoutes();
	}
}

?>