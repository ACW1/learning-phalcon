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

	public function doSigninAction()
	{
		$this->view->disable();

		$user = User::findFirst([
			"email = :email: AND password = :password:",
			"bind" => [
				"email" => $this->request->getPost('email'),
				"password" => $this->request->getPost('password')
			]
		]);

		if ($user) {
			$this->session->set('id', $user->id);
			$this->session->set('role', $user->role);
			$this->response->redirect("dashboard/index");
			return;
		}	

		$this->flash->error('Incorrect credentials');
		$this->response->redirect("signin/index");
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