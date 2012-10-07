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
	public function render($path, $vars = array())
	{
		foreach($vars as $key => $value) {
			$$key = $value;
		}
		require(__DIR__ . '/../../Public/Views/' . $path);
	}
}

?>