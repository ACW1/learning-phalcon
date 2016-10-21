<?php 

// namespace
use Phalcon\Mvc\Dispatcher,
	Phalcon\Events\Event;

class Permission extends \Phalcon\Mvc\User\Plugin
{

	protected $_privateResources = [
		'índex' => ['*'],
		'signin' => ['*']
	];

	protected $_publicResources = [
		'dashboard' => ['*']
	];

	protected $_adminResources = [
		'admin' => ['*']
	];

	protected function _getAcl()
	{
		if (!isset($this->persistent->acl))
		{

		}

		return$this->persistent->acl;
	}

	// Event interruptor
	public function beforeExecuteRoute(Event $event, Dispatcher $dispatcher)
	{
		$controller = $dispatcher->getControllerName();
		$action = $dispatcher->getActionName();
	}
}