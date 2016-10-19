<?php

use \Phalcon\Mvc\Model\Behavior\SoftDelete;

class User extends BaseModel
{
	public function initialize()
	{
		$this->addBehavior(new SoftDelete([
			'field' => 'deleted',
			'value' => 1
		]));
	}

}