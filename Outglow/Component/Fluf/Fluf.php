<?php namespace Outglow\Component\Fluf;

/**
 * A SMALL PLUGIN FOR COMMUNITY THAT
 * ALLOWS YOU TO SPECIFY CONFIGURATION
 * FOR OBJECTS THAT YOU STORE IN THE
 * CONTAINER
 * 
 * FEEL FREE TO USE / MODIFY ANY OF THIS
 * CODE FOR YOUR OWN PROJECTS
 * OPEN SOURCE / COMMERCIAL
 *
 * @author Harry Lawrence
 * @copyright Outglow Components 2012
 * @package Fluf
 * @version 1.0 BETA
 * @license The MIT License (MIT)
*/

use Outglow\Component\Community\Community;
use Outglow\Component\Memcache\Memcache;
use Symfony\Component\Yaml\Parser;

class Fluf implements \Outglow\Component\Community\CommunityInterface
{
	/**
	 * CREATE ALL PROPERTIES NEEDED
	 * TO STORE VARIOUS PIECES OF
	 * DATA ABOUT THE OBJECT THAT
	 * WILL BE USED WITH COMMUNITY
	 * @var Object
	 * @var Object
	 * @var String
	 * @var Function
	 * @var array
	 * @var array
	*/
	private $community;
	private $yamlParser;
	private $memcache = NULL;
	private $key;
	private $data;
	private $configuration;
	private $referenceArray;
	private $referenceMethods;

	private function parseToRootConfigurationFile($configurationFilePath)
	{
		return md5(end(explode('/', $configurationFilePath)));
	}

	/**
	 * - processReferenceArray
	 * PROCESS THE RETURN DATA IN
	 * THE FORM OF AN ARRAY FROM THE
	 * PREPARE METHOD CALLED
	 * @return bool
	*/
	private function processReferenceArray()
	{
		$configurationFile = $this->referenceArray[$this->key]['configuration'];
		if (file_exists($configurationFile)) {

			$configurationData = $this->yamlParser->parse(file_get_contents($configurationFile));

			if (!is_null($configurationData)) {
				foreach ($configurationData as $key => $value) {
					$methodData = array(
						'methodName'  => 'set' . $this->convertToCamelCase($key, true),
						'methodValue' => $value
					);
					$this->referenceMethods[$this->key][] = $methodData;
				}
			}
		}
		return true;
	}

	/**
	 * - convertToCamelCase
	 * CONVERT STRING TO CAMELCASE
	 * CHARACTERS
	 * @param String
	 * @param bool
	 * @return String
	*/
	private function convertToCamelCase($string, $firstCharacterCaps = false)
	{
		if($firstCharacterCaps) {
			$string[0] = strtoupper($string[0]);
		}
		$function = create_function('$c', 'return strtoupper($c[1]);');
		return preg_replace_callback('/_([a-z])/', $function, $string);
	}

	/**
	 * - constructor
	 * DEFINE ALL OF OUR INITIAL
	 * PROPERTIES
	 * @param Object
	 * @return NULL
	*/
	public function __construct(Community $community, Parser $yamlParser, Memcache $memcache = NULL)
	{
		$this->community 	 = $community;
		$this->key 			 = NULL;
		$this->data 		 = NULL;
		$this->configuration = NULL;

		$this->yamlParser = $yamlParser;
		$this->memcache   = $memcache;
	}

	/**
	 * - prepare
	 * COLLECT ALL DATA RETURNED
	 * FROM THE FUNCTION ONCE IT HAS
	 * BEEN CALLED DURING THE SETUP
	 * OF THAT OBJECT
	 * @param Function
	 * @return bool
	*/
	public function prepare($function = NULL)
	{
		if (!is_null($function)) {
			$referenceArray = $function();

			$this->key 			 = $referenceArray['key'];
			$this->data 		 = $referenceArray['data'];
			$this->configuration = $referenceArray['configuration'];

			$this->referenceArray[$this->key] = $function();
			if ($this->processReferenceArray()) {
				$this->set($this->key, $this->data, $shared = false);
			}
			return true;
		} else {
			throw new \Exception('Function must be passed as first and only param');
		}
	}

	/**
	 * - set
	 * CALLS THE NATIVE COMMUITY
	 * SET METHOD FROM WITHIN
	 * FLUF
	 * @param String
	 * @param Function
	 * @param bool
	 * @return bool
	*/
	public function set($key, $data, $shared = false)
	{
		return $this->community->set($key, $data, $shared);
	}

	/**
	 * - get
	 * GETS THE DATA FROM COMMUNITY
	 * CALLS THE SETTERS DEFINED IN
	 * THE YAML FILE THEN RETURNS
	 * THE OBJECT AS IT NORMALLY
	 * WOULD BE IN COMMUNITY
	 * @param String
	 * @return Object
	*/
	public function get($key)
	{
		$communityReturnData = $this->community->get($key);
		if (isset($this->referenceMethods[$key])) {
			if (!is_null($this->referenceMethods[$key])) {
				foreach ($this->referenceMethods[$key] as $key => $value) {
					$methodName  = $value['methodName'];
					$methodValue = $value['methodValue'];
					if (method_exists($communityReturnData, $methodName)) {
						$communityReturnData->$methodName($methodValue);
					}
				}
			}
		}
		return $communityReturnData;
	}

	/**
	 * - remove
	 * CALLS THE NATIVE COMMUNITY REMOVE
	 * METHOD FROM WITHIN FLUFF
	 * @param String
	 * @return bool
	*/
	public function remove($key)
	{
		return $this->community->remove($key);
	}
}

?>