<?php

use \Phalcon\Tag;

class SigninController extends BaseController
{
	// public function initialize()
	// {
	// 	echo "**INIT**";
	// 	$this->view->setTemplateAfter('index');
	// }

	public function indexAction()
	{
		Tag::setTitle(' Signin');
		$this->assets->collection('additional')->addCss('css/signin.css');
		parent::initialize();
		// $this->session->set('role','admin');
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