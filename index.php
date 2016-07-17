<?php
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);
    use dergus\fw\FW;

    require_once __DIR__.'/fw/FW.php';

    FW::init(__DIR__.'/app/config.php');


