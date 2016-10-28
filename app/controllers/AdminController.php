<?php

use \Phalcon\Tag; // Hoofdstuk 9.2 is volbracht

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