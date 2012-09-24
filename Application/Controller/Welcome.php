<?php namespace Application;

class Controller_Welcome extends Foundation_Controller
{
	public function init($container)
	{
		$this->append('user', new Model_User());
	}

	public function harry()
	{
		echo $this->user->name;
	}
}

?>