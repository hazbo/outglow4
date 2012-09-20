<?php
	ini_set('display_errors', 1);
	require_once('Outglow/Loader.php');
	require_once('Outglow/Stage.php');
	require_once('Outglow/Bootstrap.php');
	/**
	 * CREATE THE BOOTSTRAP
	 */
	$bootstrap = new Bootstrap(new SplClassLoader());

	/**
	 * FIRE THE BOOTSTRAP UP!
	 */
	$bootstrap->fire(new Stage());
?>