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
 * @package Foundation Controller
 * @version 1.0
 * @license The MIT License (MIT)
*/

class Foundation_Controller extends Foundation_Base_Core
{
	public function route($controller, $action, $https = false)
	{
		$protocol = 'http://';
		if ($https) {
			$protocol = 'https://';
		}
		header("location:" . $protocol . $_SERVER['HTTP_HOST'] . '/' . $controller . '/' . $action);
	}
}

?>