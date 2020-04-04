<?php
date_default_timezone_set("Europe/Prague");
session_start();

require_once './application/config/config.php';
require_once './application/lib/autoloader.php';
\Tumic\Lib\Autoloader::registerSplAutoload();



\Tumic\Config\Router::route($_REQUEST["url"]);
