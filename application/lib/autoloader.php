<?php

namespace Tumic\Lib;

/*autoloader*/

class Autoloader
{
    const BASE_PATH = './application/';

    public static function autoloadWithNamespaces($class)
    {
        $namespaces = explode('\\', $class);

        if ($namespaces[0] != 'Tumic') {
            return false;
        }
        array_shift($namespaces);

        $file = '';
        foreach ($namespaces as $namespace) {
            $file = $file . '/' . strToLower($namespace[0]) . substr($namespace, 1);
        }
        $file = $file . ".php";

        if (empty($file)) {
            return false;
        }
        return self::_autoload($file);
    }

    private static function _autoload($file)
    {
        if (file_exists(self::BASE_PATH . $file)) {
            @include_once self::BASE_PATH . $file;
            return true;
        }
        return false;
    }

    public static function registerSplAutoload()
    {
        spl_autoload_register(array('Tumic\Lib\Autoloader', 'autoloadWithNamespaces'));
        require_once __DIR__ . '/php-graph-sdk-5.0.0/src/Facebook/autoload.php';
    }
}
