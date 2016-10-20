<?php

class BaseController extends \Phalcon\Mvc\Controller
{
	public function initialize()
	{
		// adding assets
		$this->assets->addCss('css/style.css')
					 ->addJs('third-party/js/jquery.min.js');			
		// kan ook met CDNs
	}

}