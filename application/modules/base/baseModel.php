<?php

namespace Tumic\Modules\Base;

use \PDO;

abstract class BaseModel
{
    protected static $pdo;

    public function __construct()
    {
    }



    // PHP doesn't have static constructors?! OMG, using hack
    public function static_construct()
    {
        if (!self::$pdo instanceof PDO) {
            self::$pdo = new PDO(DB_CONNECTION_STRING, DB_USERNAME, DB_PASSWORD);
        }
    }
}

BaseModel::static_construct();
