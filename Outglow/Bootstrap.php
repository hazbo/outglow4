<?php

use Outglow\Component\Community\Community;
use Outglow\Component\Fluf\Fluf;
use Outglow\Component\Memcache\Memcache;
use Outglow\Component\HttpBase\HttpBase;
use Outglow\Component\Facebook\Facebook;
use Symfony\Component\Yaml\Parser;
use Fuel\Validation\Base;

class Bootstrap
{
	/**
	 * THE INITIAL PROPERTY FOR
	 * OUR CONTAINER
	 * @var NULL
	 */
	private $community = NULL;

	/**
	 * - setupOutglowCommunity
	 * LOADS IN THE DEPENDENCY
	 * INJECTION CONTAINER
	 * @return Object
	 */
	private function setupOutglowCommunity()
	{
		return $this->community = new Fluf(new Community(), new Parser());
	}

	/**
	 * - setupOutglowConfiguration
	 * LOADS THE OUTGLOW
	 * CONFIGURATION DATA
	 * @return Object
	 */
	private function setupOutglowConfiguration(Configure $configure)
	{
		return $configure->init($this->community, new Parser());
	}

	/**
	 * - setupOutglowMemcache
	 * LOADS THE OUTGLOW
	 * MEMCACHE COMPONENT
	 * @return Object
	 */
	private function setupOutglowMemcache()
	{
		return $this->community->prepare(function() {
			return array(
				'key'  => 'Memcache',
				'data' => function() {
					return new Memcache(new \Memcache());
				},
				'configuration' => __DIR__ . '/../Config/General.yml'
			);
		});
	}

	/**
	 * - setupOutglowHttpBase
	 * LOADS THE OUTGLOW
	 * HTTP BASE COMPONENT
	 * @return Object
	 */
	private function setupOutglowHttpBase()
	{
		return $this->community->set('Http', function() {
			return new HttpBase();
		});
	}

	/**
	 * - setupOutglowFacebook
	 * LOADS THE OUTGLOW
	 * FACEBOOK COMPONENT
	 * @return Object
	 */
	private function setupOutglowFacebook()
	{
		return $this->community->set('Facebook', function() {
			return new Facebook();
		});
	}

	/**
	 * - setupSymfonyYaml
	 * LOADS THE SYMFONY YAML PARSER
	 * COMPONENT
	 * @return Object
	 */
	private function setupSymfonyYaml()
	{
		return $this->community->set('Yaml', function() {
			return new Parser();
		});
	}

	/**
	 * - setupFuelValidation
	 * LOADS THE FUEL VALIDATION LIBRARY
	 * @return Object
	 */
	private function setupFuelValidation()
	{
		return $this->community->set('Validation', function() {
			return new Base();
		});
	}

	/**
	 * - constructor
	 * CALLS ALL METHODS WITHIN
	 * THIS CLASS TO LOAD ALL
	 * OTHER CLASSES
	 * @param Object
	 * @return NULL
	 */
	public function __construct(Configure $configure)
	{
		$namespaces = array(
			'Outglow\Component\Community' => __DIR__ . '/../',
			'Outglow\Component\Fluf' 	  => __DIR__ . '/../',
			'Outglow\Component\Memcache'  => __DIR__ . '/../',
			'Outglow\Component\HttpBase'  => __DIR__ . '/../',
			'Outglow\Component\Facebook'  => __DIR__ . '/../',
			'Symfony\Component\Yaml' 	  => __DIR__ . '/../Bundles/',
			'Application' 				  => __DIR__ . '/../'
		);

		foreach ($namespaces as $namespace => $path) {
			$loader = new Loader($namespace, $path);
			$loader->register();
		}

		$this->setupOutglowCommunity();
		$this->setupOutglowConfiguration($configure);
		$this->setupOutglowMemcache();
		$this->setupOutglowHttpBase();
		$this->setupOutglowFacebook();
		$this->setupSymfonyYaml();
		$this->setupFuelValidation();
	}

	/**
	 * - getContainer
	 * RETURNS THE COMMUNITY OBJECT
	 * @return Object
	 */
	public function getContainer()
	{
		return $this->community;
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
		$router->init($this->community);
	}
}

?>