<?php 

// Bootstrap file

try {
	// Autoloader
	$loader = new \Phalcon\Loader();
	$loader->registerDirs([
		'../app/controllers/',
		'../app/models/',
		'../app/config/'
		]);
		$loader->register();

		// Dependency Injection
		$di = new \Phalcon\DI\FactoryDefault();

		// Database
		$di->set('db', function() {
			$db = new \Phalcon\Db\Adapter\Pdo\Mysql([
				'host' => 'localhost',
				'username' => 'root',
				'password' => '',
				'dbname' => 'learning-phalcon'
			]);
			return $db;
		});	

		// View
		$di->set('view', function() {
			$view = new \Phalcon\Mvc\View();
			$view->setViewsDir('../app/views/');
			$view->registerEngines([
				".volt" => 'Phalcon\Mvc\View\Engine\Volt'
				]);
			return $view;
		});

		// Router
		$di->set('router', function() {
			$router = new \Phalcon\Mvc\Router();
			$router->mount(new GlobalRoutes());
			return $router;
		});

		// Session
		$di->setShared('session', function() {
			$session = new \Phalcon\Session\Adapter\Files();
			$session->start();
			return $session;
		});

		// Locates the service for the first time
		// $session = $di->get('session');

		// Returns the first instantiated object
		// $session = $di->getSession();
		
		// Meta-Data
		$di["modelsMetadata"] = function () {
    	// Instantiate a metadata adapter
    	$metadata = new \Phalcon\Mvc\Model\Metadata\Apc(array(
            "lifetime" => 86400,
            "prefix"   => "metaData",
    	));

    	// Set a custom metadata database introspection
    	// $metadata->setStrategy(
     //    new StrategyAnnotations()
    	// );

    	return $metadata;
		};

		// Customm dispatcher (overrides the default)
		$di->set('dispatcher', function() use ($di) {
			$eventsManager = $di->getShared('eventsManager');

			// Custom ACL Class
			$permission = new Permission();

			// Listen for events from the permission class
			$eventsManager->attach('dispatch', $permission);

			$dispatcher = new \Phalcon\Mvc\Dispatcher();
			$dispatcher->setEventsManager($eventsManager);
			return $dispatcher;
		});

		// Deploy the App
		$app = new \Phalcon\Mvc\Application($di);
		echo $app->handle()->getContent();

 } catch(\Phalcon\Exception $e) {
 	echo $e->getMessage();
 }