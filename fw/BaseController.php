<?php

namespace dergus\fw;

/**
*
*/
class BaseController
{
    public $layoutPath;
    public $layout='main';
    public $viewsPath;

    public function __construct()
    {
        $this->viewsPath=FW::getConfig()['basePath'].
                                DIRECTORY_SEPARATOR.
                                'controllers'.'/../views/';

        $this->layoutPath=$this->viewsPath.'layouts/';

    }

    public function render($viewFile, $vars=[])
    {
        $layoutFile=$this->layoutPath.$this->layout.'.php';
        $content=$this->renderFile($this->viewsPath.$this->getControllerName().'/'.$viewFile.'.php', $vars);
        if(file_exists($layoutFile))
            return $this->renderFile($layoutFile,
                compact('content'));
        else
            return $content;

    }

    public function renderFile($viewFile, $vars=[])
    {
        extract($vars);

        ob_start();

        require($viewFile);

        return ob_get_clean();

    }

    public function getControllerName()
    {
        $class=explode('\\',static::class);
        return strtolower(str_replace('Controller', '', end($class)));
    }

    /**
     * redirects to the given url
     * @param  string $url
     */
    public function redirect($url)
    {
        header('Location: ' . $url);
        die;
    }

}