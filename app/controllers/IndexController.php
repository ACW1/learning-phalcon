<?php

use \Phalcon\Tag;

class IndexController extends BaseController
{

	public function onConstruct()
	{
		parent::initialize();
	}

	public function indexAction()
	{
		Tag::setTitle(' Home');
		// $gateway = \Omnipay\Omnipay::create('Stripe');
		// $gateway->setApiKey('123');
		// print_r($gateway);

		// $fb = new \Facebook\Facebook([
		// 	'app_id' => 123,
  		// 	'app_secret' => 123,
		// 	]);
		// 	print_r($fb);
		// 	die;
		// kleine verandering
	}

	public function signoutAction()
	{
		$this->session->destroy();
		$this->response->redirect('index.php?_url=/index');
	}

	// Temporary Data below
	// -------------------------------------

	public function generatePasswordAction($password)
	{
		echo $this->security->hash($password);
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