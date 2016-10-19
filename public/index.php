<?php 

try {
	// Autoloader
	$loader = new \Phalcon\Loader();
	$loader->registerDirs([
		'../app/controllers/',
		'../app/models/'
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
			return $view;
		});

		// Deploy the App
		$app = new \Phalcon\Mvc\Application($di);
		echo $app->handle()->getContent();

 } catch(\Phalcon\Exception $e) {
 	echo $e->getMessage();
 }