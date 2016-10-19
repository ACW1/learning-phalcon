<?php

class UserController extends \Phalcon\Mvc\Controller
{
	public function indexAction()
	{
		$this->view->setVars([
			'single' => User::findFirstById(1),
			'all' => User::find([
				// Toont alleen de gebruikers die niet gedelete zijn 
				'deleted is NULL'
				])
			]);
	}

	public function createAction() 
	{
		$user = new User();
		$user->email = "test@test.com";
		$user->password = "test";
		$user->created_at = date("Y-m-d H:i:s");
		$result = $user->save();
		if (!$result) {
			print_r($user->getMessages());
		}
	}

	public function createAssocAction()
	{
		$user = User::findFirst(1);
		$project = new Project();
		$project->user = $user;
		$project->title = "Moonwalker";
		$result = $project->save();
	}

	public function updateAction() 
	{
		$user = User::findFirstById(8);
		if (!$user) {
			echo "User does not exist";
			die;
		}

		$user->email = "updated@test.com";
		$result = $user->update();
		if (!$result) {
			print_r($user->getMessages());
		}
	}

	public function deleteAction()
	{
		$user = User::findFirstById(4);
		if (!$user) {
			echo "User does not exist";
			die;
		}
		$result = $user->delete();
		if (!$result) {
			print_r($user->getMessages());
		}
	}

}