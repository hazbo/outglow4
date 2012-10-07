<?php namespace Application;

class Controller_Welcome extends Foundation_Controller
{
	public function init($container, $routes)
	{
		$this->append('container', $container);
		$this->append('user', new Model_User());
		$this->append('view', new View_Welcome());
	}

	public function home()
	{
		echo 'Here';
		// Render home page view
		//$this->view->generate();
		//$database = $this->container->get('Database');
	}

	public function adan()
	{
		echo 'Hello adan';
	}

	public function login()
	{
		// Creates the facebook object
		$facebook = $this->container->get('Facebook');

		// Configures using the facebook app settings to authenticate
		$facebook->config(array(
	    	'client_id' 	=> '503694292993707',
	    	'client_secret' => 'a3f81d61fc17ecc23b38a84614aa02a2',
	    	'redirect_uri'  => 'http://harry.pagekite.me/welcome/login/',
	    	'scope' 		=> 'email',
	    	'state' 		=> md5(uniqid() . rand())
		));

		// Authenticates
		//$facebook->authenticate();

		// Gets user data
		//$userData = $facebook->getLoggedInUser();

		// Accesses the user model to register/login
		if (strlen($this->container->get('Session')->get('fb_access_token')) > 10) {
			$this->user->createOrLogin(/*pass in facebook generated data: $userData*/);
		}
	}
}

?>