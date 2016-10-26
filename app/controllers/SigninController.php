<?php

use \Phalcon\Tag;

class SigninController extends BaseController
{
	// public function initialize()
	// {
	// 	echo "**INIT**";
	// 	$this->view->setTemplateAfter('index');
	// }

	public function onConstruct()
	{
		parent::initialize();
	}

	public function indexAction()
	{
		Tag::setTitle(' Signin');
		$this->assets->collection('additional')->addCss('css/signin.css');
		// $this->session->set('role','admin');
	}

	public function doSigninAction()
	{
		$this->view->disable();
		// csrf-helper aanroepen
		$this->component->helper->csrf("signin/index");
		
		$email    = $this->request->getPost("email");
        $password = $this->request->getPost("password");

        $user = User::findFirstByEmail($email);
        if ($user) {
            if ($this->security->checkHash($password, $user->password)) 
            {
                // The password is valid
                $this->component->user->createSession($user);
                $this->response->redirect("dashboard/index");
				return;
            } 
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

	public function registerAction() 
	{
		Tag::setTitle(' Register');
		$this->assets->collection('additional')->addCss('css/signin.css');
	}

	public function doRegisterAction() 
	{
		if ($this->security->checkToken() == false)
		{
			$this->flash->error('Invalid CSRF token.');
			$this->response->redirect("signin/register");
			return;
		}

		$this->view->disable();

		$email = $this->request->getPost('email');
		$password = $this->request->getPost('password');
		$confirm_password = $this->request->getPost('confirm_password');

		if ($password != $confirm_password) {
			$this->flash->error('Your passwords do not match.');
			$this->response->redirect("signin/register");
		}

		$user = new User();
		$user->role = 'user';
		$user->email = $email;
		$user->password = $password;
		$result = $user->save();

		if (!$result) {
			$output = [];
			foreach ($user->getMessages() as $message) {
				$output[] = $message;
			}
			$output = implode(', ', $output);
			$this->flash->error($output);
			$this->response->redirect("signin/register");
			return;
		}

		$this->_createUserSession($user);

	}


}