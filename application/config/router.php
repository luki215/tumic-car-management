<?php

namespace Tumic\Config;

use Tumic\Modules\Vehicles\VehiclesController;
use Tumic\Modules\NotFound\NotFoundController;

class Router
{
    public static function route(string $url)
    {
        $parts = explode('/', $url, 3);
        $controllerToHandle = null;
        switch ($parts[0]) {
            case "vehicles":
                $controllerToHandle = VehiclesController::getInstance();
                break;
            default:
                $controllerToHandle = NotFoundController::getInstance();
                break;
        }

        $action = count($parts) === 1 || @$parts[1] === "" ? "index" : $parts[1];
        if (is_callable(array($controllerToHandle, $action))) {
            $controllerToHandle->$action(@$parts[2]);
        } else {
            NotFoundController::getInstance()->index();
        }
    }
}
