<?php

namespace dergus\fw;

/**
*
*/
class FrontController
{

    public $cns='\\app\controllers\\';
    public $defaultController='site';
    public $defautAction='index';
    public $controllerDir='controllers';
    public $errorController='site';
    public $errorAction='error';

    public function __construct()
    {
        $this->controllerDir=FW::getConfig()['basePath'].
                                DIRECTORY_SEPARATOR.
                                $this->controllerDir;
    }

    public  function run()
    {

        if(isset($_GET['r']) && !empty($_GET['r'])){
            $r=$_GET['r'];

            $routeAr=explode('/', $r);

            $controller=$routeAr[0];
            if(isset($routeAr[1])){
                $action=$routeAr[1];
            }else{
                $action=$this->defautAction;
            }

        }else{
            $controller=$this->defaultController;
            $action=$this->defautAction;
        }

        $controller=ucfirst($controller.'Controller');
        $action='action'.ucfirst($action);


        if($this->routeExists($controller,$action)){

            $cname= $this->cns.$controller;
            $c= new $cname;

            echo $c->$action();
        }else{
            $errorController=ucfirst($this->errorController).'Controller';
            $errorAction='action'.$this->errorAction;

            if($this->routeExists($errorController,$errorAction)){

                    $cname= $this->cns.$errorController;
                    $c= new $cname;

                    echo $c->$errorAction();
            }else{
                echo "404";
            }
        }
    }

    protected function routeExists($controller,$action){


        $controllerPath=$this->controllerDir.
        DIRECTORY_SEPARATOR.$controller.'.php';

        // echo $controllerPath.'::'.$action.' | ';
        if(file_exists($controllerPath)){

            require_once($controllerPath);
            if(method_exists($this->cns."SiteController",$action)){
                // echo "ww";
                return true;
            }
        }

        return false;
    }
}