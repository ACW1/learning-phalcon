<?php

use \Phalcon\Tag; // Hoofdstuk 10 -- it's a wrap!

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