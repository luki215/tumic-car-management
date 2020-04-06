<?php
date_default_timezone_set("Europe/Prague");
session_start();

require_once './application/config/config.php';
require_once './application/lib/autoloader.php';
\Tumic\Lib\Autoloader::registerSplAutoload();

// store current controller and action, set up by Router
global $controller, $action;

\Tumic\Config\Router::getInstance()->route($_REQUEST["url"]);
