<?php
namespace Component;

class Helper extends \Phalcon\Mvc\User\Component
{
	public function csrf($redirect = false) 
	{
		if ($this->security->checkToken() == false)
		{
			$this->flash->error('Invalid CSRF token.');
			if ($redirect) {
				$this->response->redirect($redirect);
			}
			return;
		}

	}
}