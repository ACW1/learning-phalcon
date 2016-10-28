<?php

use \Phalcon\Tag; // Hoofdstuk 9.3 ook

class AdminController extends BaseController
{
	public function onConstruct()
	{
		parent::initialize();
	}
	
	public function indexAction()
	{
		Tag::setTitle(' Admin');
	}
}