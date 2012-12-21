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
	 * @var NULL
	 */
	private $container 	   = NULL;
	private $softContainer = NULL;

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
	 * - setSoftContainer
	 * SETS UP OUR CONTAINTER
	 * PROPERTY FOR THIS INTERNAL
	 * SETTINGS
	 * @param Object
	 * @return bool
	 */
	private function setSoftContainer($newSoftContainer)
	{
		return $this->softContainer = $newSoftContainer;
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
	 * - loadOutglowFluf
	 * LOADS IN THE WRAPPER FOR
	 * COMMUNITY FOR EXTRA
	 * CONFIGURATION
	 * @return Object
	 */
	private function loadOutglowFluf(\Outglow\Component\Community\Community $community, $symfonyYamlParser)
	{
		$loader = new Loader('Outglow\Component\Fluf', __DIR__ . '/../');
		$loader->register();
		return new Outglow\Component\Fluf\Fluf($community, $symfonyYamlParser);
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
	 * - loadOutglowSession
	 * LOADS THE OUTGLOW
	 * SESSION COMPONENT
	 * @return Object
	 */
	private function loadOutglowSession()
	{
		$loader = new Loader('Outglow\Component\Session', __DIR__ . '/../');
		$loader->register();
		return $this->container->set('Session', function() {
			return new Outglow\Component\Session\Session();
		});
	}

	/**
	 * - loadOutglowRedBean
	 * LOADS THE OUTGLOW
	 * REDBEAN COMPONENT
	 * @return Object
	 */
	private function loadOutglowDatabase()
	{
		$loader = new Loader('Outglow\Component\RedBean', __DIR__ . '/../');
		$loader->register();
		return $this->container->set('Database', function() {
			return new Outglow\Component\RedBean\Database();
		});
	}

	/**
	 * - loadOutglowFacebook
	 * LOADS THE OUTGLOW
	 * FACEBOOK COMPONENT
	 * @return Object
	 */
	private function loadOutglowFacebook()
	{
		$loader = new Loader('Outglow\Component\Facebook', __DIR__ . '/../');
		$loader->register();
		return $this->container->prepare(function() {
			return array(
				'key'  => 'Facebook',
				'data' => function() {
					return new Outglow\Component\Facebook\Facebook();
				},
				'configuration' => 'Config/Facebook.yml'
			);
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
		}, true);
	}

	/**
	 * - loadFuelValidation
	 * LOADS THE FUEL VALIDATION LIBRARY
	 * @return Object
	 */
	private function loadFuelValidation()
	{
		$loader = new Loader('Fuel\Validation' , __DIR__ . '/../Bundles/');
		$loader->register();
		return $this->container->set('Validation', function() {
			return new Fuel\Validation\Base();
		});
	}

	private function loadMemcache()
	{
		if (class_exists('Memcache')) {
			$loader = new Loader('Outglow\Component\Memcache', __DIR__ . '/../');
			$loader->register();
			return $this->container->prepare(function() {
				return array(
					'key'  => 'Memcache',
					'data' => function() {
						return new Outglow\Component\Memcache\Memcache(new \Memcache());
					},
					'configuration' => 'Config/Memcache.yml'
				);
			});
		}
		return false;
	}

	/**
	 * - loadSoftContainerYamlComponent
	 * LOADS THE SYMFONY YAML COMPONENT
	 * FOR FLUF
	 * @return Object
	 */
	private function loadSoftContainerYamlComponent()
	{
		$loader = new Loader('Symfony\Component\Yaml' , __DIR__ . '/../Bundles/');
		$loader->register();
		return $this->softContainer->set('Yaml', function() {
			return new Symfony\Component\Yaml\Parser();
		}, true);
	}

	/**
	 * - constructor
	 * CALLS ALL METHODS WITHIN
	 * THIS CLASS TO LOAD ALL
	 * OTHER CLASSES
	 * @return NULL
	 */
	public function __construct()
	{
		/**
		 * LOADS IN THINGS NEEDED INTERNALLY
		 */
		$this->setSoftContainer($this->loadOutglowCommunity());
		$this->loadSoftContainerYamlComponent();

		/**
		 * SETS THE CONTAINER USING FLUF
		 */
		$this->setContainer($this->loadOutglowFluf($this->loadOutglowCommunity(), $this->softContainer->get('Yaml')));

		/**
		 * LOADS IN ALL INTERNAL COMPONENTS
		 */
		$this->loadOutglowHttpBase();
		$this->loadOutglowSession();
		$this->loadOutglowDatabase();
		$this->loadOutglowFacebook();

		/**
		 * LOADS IN ALL EXTERNAL COMPONENTS
		 */
		$this->loadSymfonyYaml();
		$this->loadFuelValidation();
		$this->loadMemcache();

		/**
		 * UNSETS SOFT COMPONENTS AND RUNS
		 * THE APPLICATION
		 */
		$this->setSoftContainer(NULL);
		$this->loadApplication();
	}

	/**
	 * - fire
	 * FIRES OUR AUTOLOADER ROUTER
	 * AFTER EVERYTHING ELSE
	 * @param Object
	 * @return bool
	 */
	public function fire(Configure $configure, Autorouter $router)
	{
		$configure->init($this->container);
		$router->init($this->container);
	}
}
	
?>