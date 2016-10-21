<?php 

// namespace
use Phalcon\Mvc\Dispatcher,
    Phalcon\Events\Event,
    Phalcon\Acl;

class Permission extends \Phalcon\Mvc\User\Plugin
{
    // Constants to prevent a typo
    const GUEST = 'guest';
    const USER = 'user';
    const ADMIN = 'admin';

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

    // Event interruptor
    public function beforeExecuteRoute(Event $event, Dispatcher $dispatcher)
    {
        
        $role = $this->session->get('role');
        // var_dump($role);
        if (!$role) {
            $role = self::GUEST;
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
      
        if ($allowed != Acl::ALLOW)
        {
            $this->flash->error("You do not have permission to access this area.");
            $this->response->redirect('index');
            // $this->dispatcher->forward([
            //     'controller' => 'index',
            //     'action' => 'index'
            // ]);

            // Stops the dispatcher at the current operation
            return false;

        }
    }

    //     protected function _getAcl()
    // {
    //     $this->persistent->destroy();
    //     if (!isset($this->persistent->acl))
    //     {
    //         $acl = new Acl\Adapter\Memory();
    //         $acl->setDefaultAction(Acl::DENY);

    //         $roles = [
    //             self::GUEST => new Acl\Role(self::GUEST),
    //             self::USER => new Acl\Role(self::USER),
    //             self::ADMIN => new Acl\Role(self::ADMIN)
    //         ];

    //         foreach ($roles as $role) {
    //             $acl->addRole($role);
    //         }

    //         // Public resources
    //         foreach ($this->_publicResources as $resource => $action) {
    //             $acl->addResource(new Acl\Resource($resource), $action);
    //         }

    //         // User resources
    //         foreach ($this->_userResources as $resource => $action) {
    //             $acl->addResource(new Acl\Resource($resource), $action);
    //         }

    //         // Admin resources
    //         foreach ($this->_adminResources as $resource => $action) {
    //             $acl->addResource(new Acl\Resource($resource), $action);
    //         }

    //         // Loop through the roles - Allow all roles to access the public resources
    //         foreach ($roles as $role) {
    //             foreach ($this->_publicResources as $resource => $action) {
                   
                   
    //                 $acl->allow($role->getName(), $resource, '*');
    //             }
    //         }

    //         // Allow User and Admin to access the User resources 
    //         foreach ($this->_userResources as $resource => $action) {
    //             foreach ($action as $action) {
    //                 $acl->allow(self::USER, $resource, $action);
    //                 $acl->allow(self::ADMIN, $resource, $action);
    //             }
    //         }

    //         // Allow Admin to access the Admin resources
    //         foreach ($this->_adminResources as $resource => $action) {
    //             foreach ($action as $action) {
    //                 $acl->allow(self::ADMIN, $resource, $action);
    //             }
    //         }

    //         $this->persistent->acl = $acl;
    //     }
    //     return $this->persistent->acl;
    // }

    /**
     * Build the Session ACL list one time if it's not set
     *
     * @return object
     */
    protected function _getACL()
    {
        if (!isset($this->persistent->acl))
        {
            $acl = new Acl\Adapter\Memory();
            $acl->setDefaultAction(Acl::DENY);

            $roles = [
                self::GUEST => new Acl\Role(self::GUEST),
                self::USER  => new Acl\Role(self::USER),
                self::ADMIN => new Acl\Role(self::ADMIN),
            ];

            // Place all the roles inside the ACL Object
            foreach ($roles as $role) {
                $acl->addRole($role);
            }

            // Public Resources
            foreach ($this->_publicResources as $resource => $action) {
                $acl->addResource(new Acl\Resource($resource), $action);
            }

            // User Resources
            foreach ($this->_userResources as $resource => $action) {
                $acl->addResource(new Acl\Resource($resource), $action);
            }

            // Admin Resources
            foreach ($this->_adminResources as $resource => $action) {
                $acl->addResource(new Acl\Resource($resource), $action);
            }

            // Allow ALL Roles to access the Public Resources
            foreach ($roles as $role) {
                foreach($this->_publicResources as $resource => $action) {
                    $acl->allow($role->getName(), $resource, '*');
                }
            }

            // Allow User & Admin to access the User Resources
            foreach ($this->_userResources as $resource => $actions) {
                foreach ($actions as $action) {
                    $acl->allow(self::USER, $resource, $action);
                    $acl->allow(self::ADMIN, $resource, $action);
                }
            }

            // Allow Admin to access the Admin Resources
            foreach ($this->_adminResources as $resource => $actions) {
                foreach ($actions as $action) {
                    $acl->allow(self::ADMIN, $resource, $action);
                }
            }

            $this->persistent->acl = $acl;
        }

        return $this->persistent->acl;
    }

}