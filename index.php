<?php
	session_start();
	ini_set('display_errors', 1);

	require_once('Outglow/Loader.php');
	require_once('Outglow/Bootstrap.php');
	require_once('Outglow/Configure.php');
	require_once('Outglow/Autorouter.php');
	/*
	require_once('Outglow/Tools.php');
	require_once('Outglow/Bootstrap.php');
	require_once('Outglow/Cache.php');
	if (file_exists('vendor/autoload.php')) {
		require_once('vendor/autoload.php');
	}*/

	$bootstrap = new Bootstrap(new Configure());



	/**
	 * CREATE THE BOOTSTRAP
	 */
	#$bootstrap = new Bootstrap();

	/**
	 * SEE IF WE HAVE ANY CACHING TO DO
	 * IF YOU'RE READING THIS, AND YOU
	 * DO NOT HAVE MEMCACHE INSTALLED
	 * AND RUNNING, GO GET IT! DON'T
	 * GET ME WRONG, YOU DON'T NEED IT
	 * TO RUN OUTGLOW, BUT IT'S WORTH IT
	 */
	#$cache = new Cache($bootstrap);

	/**
	 * FIRE THE BOOTSTRAP AND
	 * PASS IN THE AUTOROUTER
	 */
	$bootstrap->fire(new Autorouter());
?>