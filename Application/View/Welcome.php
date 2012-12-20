<?php namespace Application;

class View_Welcome extends Foundation_View
{
	public function generate($data = array())
	{
		$this->select('Layouts/Welcome.php');
		$this->createPlaceHolders(array(
			'name' => 'Harry',
			'age'  => '20'
		));

		$this->draw();
	}
}
	
?>