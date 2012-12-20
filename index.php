<?php
	session_start();
	ini_set('display_errors', 1);
	require_once('Outglow/Loader.php');
	require_once('Outglow/Autorouter.php');
	require_once('Outglow/Bootstrap.php');
	require_once('Outglow/Configure.php');
	if (file_exists('vendor/autoload.php')) {
		require_once('vendor/autoload.php');
	}

	/**
	 * CREATE THE BOOTSTRAP
	 */
	$bootstrap = new Bootstrap();

	/**
	 * FIRE THE BOOTSTRAP AND
	 * PASS IN THE AUTOROUTER
	 */
	$bootstrap->fire(new Configure(), new Autorouter());
?>