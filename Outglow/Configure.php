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
 * @package Configure
 * @version 1.0
 * @license The MIT License (MIT)
*/

class Configure
{
	/**
	 * THE INITIAL PROPERTY FOR
	 * OUR CONTAINER
	 * @var Object
	 */
	private $container;

	/**
	 * - getConfigContents
	 * PULLS IN OUR GENERAL CONFIG
	 * DATA
	 * @param String
	 * @return String
	 */
	private function getConfigContents($file)
	{
		return file_get_contents(__DIR__ . '/../Config/' . $file . '.yml');
	}

	/**
	 * - loadConfigGeneral
	 * RETURNS ARRAY OF CONFIGURATION
	 * SETTINGS FROM CONFIG FILE
	 * @return array
	 */
	private function loadConfigGeneral()
	{
		$parser = $this->container->get('Yaml');
		return $parser->parse($this->getConfigContents('General'));
	}

	/**
	 * - init
	 * SETS THE DATA INSIDE THE
	 * CONTAINER
	 * @param Object
	 * @return bool
	 */
	public function init(Outglow\Component\Fluf\Fluf $container)
	{
		$this->container = $container;
		$options = array (
			'general' => $this->loadConfigGeneral(),
		);
		$this->container->set('Config', function($options) {
			return $options;
		}, $options, true);
		return true;
	}
}

?>