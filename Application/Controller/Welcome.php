<?php namespace Application;

class Controller_Welcome extends Foundation_Controller
{
	public function init($container)
	{
		$this->append('http', $container->get('HttpBase'));
	}

	public function test()
	{
		
	}
}

?>