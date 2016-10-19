<?php

class LoginController extends \Phalcon\Mvc\Controller
{
	public function initialize()
	{
		// echo "**INIT**";
		$this->view->setTemplateAfter('default');
	}

	public function indexAction()
	{
		echo "Login!";
	}

	// /login/process/<naam>/<leeftijd>
	public function processAction($username = false, $age = 12) 
	{
		// echo "Processing";
		// echo $username;
		// echo $age;

		// http://docs.phalconphp.com/en/latest/api/Phalcon_Mvc_View.html
		$this->view->setVar('username', $username);
		$this->view->setVar('age', $age);

		$this->view->disableLevel(\Phalcon\Mvc\View::LEVEL_AFTER_TEMPLATE);

		// $this->dispatcher->forward([
		// 	'controller' => 'login',
		// 	'action' => 'test'
		// ]);
	}

	// public function testAction()
	// {
	// 	echo "-- TEST ACTION --";
	// }

}