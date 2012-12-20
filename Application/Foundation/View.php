<?php namespace Application;

/**
 * OUTGLOW 4 RELEASE FRAMEWORK
 * 
 * FEEL FREE TO USE / MODIFY ANY OF THIS
 * CODE FOR YOUR OWN PROJECTS
 * OPEN SOURCE / COMMERCIAL
 *
 * @author Harry Lawrence
 * @copyright Outglow 2012
 * @package Foundation View
 * @version 1.0
 * @license The MIT License (MIT)
*/

class Foundation_View extends Foundation_Base_Core
{
	private $fileContents;

	public function select($path, $vars = array())
	{
		foreach($vars as $key => $value) {
			$$key = $value;
		}
		$this->fileContents = file_get_contents(__DIR__ . '/../../Public/Views/' . $path);
	}

	public function createPlaceholder($key, $value)
	{
		return $this->fileContents = preg_replace('#\{{' . $key . '\}}#s', $value, $this->fileContents);
	}

	public function createPlaceholders($keysAndValues = array())
	{
		foreach ($keysAndValues as $key => $value) {
			$this->createPlaceHolder($key, $value);
		}
		return true;
	}

	public function draw()
	{
		print $this->fileContents;
	}
}

?>