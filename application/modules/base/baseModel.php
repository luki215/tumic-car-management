<?php

namespace Tumic\Modules\Base;

use \PDO;

abstract class BaseModel
{
    protected static $pdo;

    public function __construct()
    {
    }

    protected function check_lock()
    {

        if ($this->id) {
            $current_inst = $this->get($this->id);
            if ($current_inst->updated_at != $this->updated_at) {
                $this->errors["race_condition"] = $current_inst;
                $this->updated_at = $current_inst->updated_at;
                return false;
            }
        }
        return true;
    }

    // PHP doesn't have static constructors?! OMG, using hack
    public function static_construct()
    {
        if (!self::$pdo instanceof PDO) {
            self::$pdo = new PDO(DB_CONNECTION_STRING, DB_USERNAME, DB_PASSWORD);
        }
    }

    public abstract static function get($id);
}

BaseModel::static_construct();
