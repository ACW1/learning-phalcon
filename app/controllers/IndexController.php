<?php

class IndexController extends \Phalcon\Mvc\Controller
{
	public function indexAction()
	{
		echo "Hello World!";
	}

	public function startSessionAction()
	{
		// $this->session->set('name', 'Arthur');
		$this->session->set('user', [
			'name' => 'Ted',
			'age' => 55,
			'soOn' => 'soForth'
			]);
	}

	public function getSessionAction()
	{
		// echo $this->session->get('name');
		$user = $this->session->get('user');
		print_r($user);
	}

	public function removeSessionAction()
	{
		echo $this->session->remove('name');
	}

	public function destroySessionAction()
	{
		echo $this->session->destroy();
	}
}