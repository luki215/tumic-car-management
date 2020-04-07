<?php

namespace Tumic\Lib;

use Tumic\Lib\Singleton;

class ParamConverter
{
    private $converters = [];
    use Singleton;
    public function __construct()
    {
        $this->converters["datetime"] = function ($x) {
            if (isset($x) && $x !== "") {
                return date('Y-m-d H:i:s', strtotime($x));
            } else return null;
        };

        $this->converters["bool"] = function ($x) {
            return $x ? 1 : 0;
        };
    }

    /**
     * convert to correct mysql-accepted data types
     * @param $params = keyVal params
     * @param $types = keyVal where key = supported convert type, value = list of keys on $params to convert to that type
     */
    public function convertParams($params, $types)
    {
        foreach ($types as $type => $keys) {
            $params = $this->convertParam(
                $params,
                $keys,
                $this->converters[$type]
            );
        }
        return $params;
    }

    private function convertParam($params, $keys, $modifier)
    {
        foreach ($keys as $key) {
            $params[$key] = $modifier(@$params[$key]);
        }
        return $params;
    }
}
