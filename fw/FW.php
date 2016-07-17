<?php

namespace dergus\fw;

/**
*
*/
class FW
{
    public static $configPath=null;


    public static function getConfig()
    {
        if(!self::$configPath)
            return false;

        return require(self::$configPath);
    }

/**
 * Initiates and runs the app
 * @param  [type] $configPath [description]
 * @return [type]             [description]
 */
    public static function init($configPath)
    {
        self::$configPath=$configPath;

        spl_autoload_register([__CLASS__,'autoload']);

        (new FrontController)->run();
    }

    public static function autoload($class)
    {
            $ns=explode("\\",__NAMESPACE__);
            $appNS=isset(FW::getConfig()['appNS'])?FW::getConfig()['appNS']:'app';
            $class=explode("\\",$class);
            if($class[0]==$ns[0]){

                $filePath=join('/',array_diff($class, $ns));

                $file=__DIR__.'/' . $filePath . '.php';

            }elseif($class[0]=='app'){
                unset($class[0]);

                $file=FW::getConfig()['basePath'].'/' . join('/',$class) . '.php';
            }

            if(file_exists($file)){
                require_once $file;
            }
    }


    public static function getService($name,$args=[])
    {
        $config=self::getConfig();

        if($config && isset($config['services']) && isset($config['services'][$name])){

            return $config['services'][$name]($args);
        }

        return null;
    }


}