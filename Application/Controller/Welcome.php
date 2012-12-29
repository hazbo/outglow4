<?php namespace Application;

class Controller_Welcome extends Foundation_Controller
{
	private $container;

	public function init($container)
	{
		$this->container = $container;
		$this->append('View', new View_Welcome());
	}

	public function home()
	{
		$jade = $this->container->get('Jade');
		echo $jade->render('Layouts/Welcome.jade');
	}
}

?>