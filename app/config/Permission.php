<?php 

// namespace
use Phalcon\Mvc\Dispatcher,
    Phalcon\Events\Event;

class Permission extends \Phalcon\Mvc\User\Plugin
{

    protected $_publicResources = [
        'index' => '*',
        'signin' => '*'
    ];

    protected $_userResources = [
        'dashboard' => ['*']
    ];

    protected $_adminResources = [
        'admin' => ['*']
    ];

    protected function _getAcl()
    {
        $this->persistent->destroy();
        if (!isset($this->persistent->acl))
        {
            $acl = new \Phalcon\Acl\Adapter\Memory();
            $acl->setDefaultAction(Phalcon\Acl::DENY);

            $roles = [
                'guest' => new \Phalcon\Acl\Role('guest'),
                'user' => new \Phalcon\Acl\Role('user'),
                'admin' => new \Phalcon\Acl\Role('admin')
            ];

            foreach ($roles as $role) {
                $acl->addRole($role);
            }

            // Public resources
            foreach ($this->_publicResources as $resource => $action) {
                $acl->addResource(new \Phalcon\Acl\Resource($resource), $action);
            }

            // User resources
            foreach ($this->_userResources as $resource => $action) {
                $acl->addResource(new \Phalcon\Acl\Resource($resource), $action);
            }

            // Admin resources
            foreach ($this->_adminResources as $resource => $action) {
                $acl->addResource(new \Phalcon\Acl\Resource($resource), $action);
            }

            // Loop through the roles - Allow all roles to access the public resources
            foreach ($roles as $role) {
                foreach ($this->_publicResources as $resource => $action) {
                   
                   
                    $acl->allow($role->getName(), $resource, '*');
                }
            }

            // Allow User and Admin to access the User resources 
            foreach ($this->_userResources as $resource => $action) {
                foreach ($action as $action) {
                    $acl->allow('user', $resource, $action);
                    $acl->allow('admin', $resource, $action);
                }
            }

            // Allow Admin to access the Admin resources
            foreach ($this->_adminResources as $resource => $action) {
                foreach ($action as $action) {
                    $acl->allow('admin', $resource, $action);
                }
            }

            $this->persistent->acl = $acl;
        }
        return $this->persistent->acl;
    }

    // Event interruptor
    public function beforeExecuteRoute(Event $event, Dispatcher $dispatcher)
    {
        
        $role = $this->session->get('role');
        // var_dump($role);
        if (!$role) {
            $role = 'guest';
        }

        // Get the current controller/Action from the dispatcher
        $controller = $dispatcher->getControllerName();
        $action = $dispatcher->getActionName();

        // Get the ACL Rule list
        $acl = $this->_getAcl();

 // echo $role;

        // See if they have permission
        $allowed = $acl->isAllowed($role, $controller, $action);
        // echo $allowed;
        // die;
      
        if ($allowed != Phalcon\Acl::ALLOW)
        {
            $this->dispatcher->forward([
                'controller' => 'index',
                'action' => 'index'
            ]);

            // Stops the dispatcher at the current operation
            return false;

        }
    }
}