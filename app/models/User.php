<?php

use \Phalcon\Mvc\Model\Behavior\SoftDelete;
use \Phalcon\Mvc\Model;
use \Phalcon\Validation;
use \Phalcon\Validation\Validator\Email as EmailValidator;
use \Phalcon\Validation\Validator\Uniqueness as UniquenessValidator;
use \Phalcon\Security;

class User extends BaseModel
{
	public function initialize()
	{	
		// local field, referenced model, referenced field.
		$this->hasMany('id', 'Project', 'user_id');

		$this->addBehavior(new SoftDelete([
			'field' => 'deleted',
			'value' => 1
		]));
	}

	public function validation() 
	{

		$validator = new Validation();

        $validator->add(
            'email',
            new EmailValidator([
                'model' => $this,
                'message' => 'Your email is invalid'
            ])
        );

        $validator->add(
            'email',
            new UniquenessValidator([
                'model' => $this,
                'message' => 'Your email is already in use'
            ])
        );
        $security = new Security;
		$this->password = $security->hash($this->password);
		
        return $this->validate($validator);
		
		// if ($this->validationHasFailed()) {
		// 	return false;
		
		}
		
}