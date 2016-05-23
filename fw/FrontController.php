<?php

namespace dergus\fw;

/**
* 
*/
class FrontController
{
	
	public $defaultController='site';
	public $defautAction='index';
	public $controllerDir;
	public $errorController='site';
	public $errorAction='error';

	public  function run()
	{
		
		if(isset($_GET['r']) && !empty($_GET['r'])){
			$r=$_GET['r'];

			$routeAr=explode('/', $r);

			$controller=$routeAr[0];
			if($isset($routeAr[1])){
				$action=$routeAr[1];
			}else{
				$action=$this->defautAction;
			}

		}else{
			$controller=$this->defautController;
			$action=$this->defautAction;
		}

		$controller=$controller.'Controller';
		$action='action'.$action;

		$controllerPath=$this->controllerDir.
		DIRECTORY_SEPARATOR.$controller.'.php';
		if($this->routeExists($controller,$action)){

			$c= new $controller;

			echo $c->$action();
		}else{
			$errorController=$this->errorController.'Controller';
			$errorAction='action'.$this->errorAction();

			if($this->routeExists($controller,$action)){
				echo (new $errorController)->$errorAction();
			}else{
				echo "404";
			}
		}
	}

	protected function routeExists($controller,$action){


		$controllerPath=$this->controllerDir.
		DIRECTORY_SEPARATOR.$controller.'.php';

		if(file_exists($controllerPath)){

			require_once($controllerPath);

			if(method_exists($controllerPath,$action))
				return true;
		}

		return false;
	}
}