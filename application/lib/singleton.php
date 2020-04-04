<?php

namespace Tumic\Lib;

trait Singleton
{
    private static $instances = array();
    protected static $instance;

    /**
     * Singleton creator
     * @return static
     */
    final public static function getInstance()
    {
        $className = get_called_class();
        if (!isset(self::$instances[$className])) {
            self::$instances[$className] = new static();
        }
        return self::$instances[$className];
    }

    private function __clone()
    {
        //touto metodou zakazujeme klonování daného objektu
    }
}
