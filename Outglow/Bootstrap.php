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
 * @package Bootstrap
 * @version 1.0
 * @license The MIT License (MIT)
*/

class Bootstrap
{
	/**
	 * THE INITIAL PROPERTY FOR
	 * OUR CONTAINER
	 * @var NULL
	 */
	private $container = NULL;

	/**
	 * - constructor
	 * CALLS ALL METHODS WITHIN
	 * THIS CLASS TO LOAD ALL
	 * OTHER CLASSES
	 * @return NULL
	 */
	public function __construct()
	{
		$this->setContainer($this->loadOutglowCommunity());

		$this->loadOutglowHttpBase();
		$this->loadSymfonyYaml();

		$this->loadApplication();
	}

	/**
	 * - loadApplication
	 * REGISTERS THE APPLICATION
	 * NAMESPACES
	 * @return bool
	 */
	private function loadApplication()
	{
		$loader = new Loader('Application', __DIR__ . '/../');
		$loader->register();
		return true;
	}

	/**
	 * - setContainer
	 * SETS UP OUR CONTAINTER
	 * PROPERTY FOR THIS CLASS
	 * @param Object
	 * @return bool
	 */
	private function setContainer($newContainer)
	{
		return $this->container = $newContainer;
	}

	/**
	 * - fire
	 * FIRES OUR AUTOLOADER ROUTER
	 * AFTER EVERYTHING ELSE
	 * @param Object
	 * @return bool
	 */
	public function fire(Autorouter $router)
	{
		return $router->init($this->container);
	}

	/**
	 * - loadOutglowCommunity
	 * LOADS IN THE DEPENDENCY
	 * INJECTION CONTAINER
	 * @return Object
	 */
	private function loadOutglowCommunity()
	{
		$loader = new Loader('Outglow\Component\Community', __DIR__ . '/../');
		$loader->register();
		return new Outglow\Component\Community\Community();
	}

	/**
	 * - loadOutglowHttpBase
	 * LOADS THE OUTGLOW
	 * HTTP BASE COMPONENT
	 * @return Object
	 */
	private function loadOutglowHttpBase()
	{
		$loader = new Loader('Outglow\Component\HttpBase', __DIR__ . '/../');
		$loader->register();
		return $this->container->set('HttpBase', function() {
			return new Outglow\Component\HttpBase\HttpBase();
		});
	}

	/**
	 * - loadSymfonyYaml
	 * LOADS THE SYMFONY YAML PARSER
	 * COMPONENT
	 * @return Object
	 */
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