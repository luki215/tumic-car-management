<?php

namespace Tumic\Config;

use Tumic\Lib\Singleton;
use Tumic\Modules\Home\HomeController;
use Tumic\Modules\Vehicles\VehiclesController;
use Tumic\Modules\NotFound\NotFoundController;

class Router
{
    use Singleton;
    public $controller;
    public $action;
    public function route(string $url)
    {
        $parts = explode('/', $url, 3);
        $controllerToHandle = null;
        switch ($parts[0]) {
            case "vehicles":
                $controllerToHandle = VehiclesController::getInstance();
                break;
            case "":
                $controllerToHandle = HomeController::getInstance();
                break;
            default:
                $controllerToHandle = NotFoundController::getInstance();
                break;
        }

        $action = count($parts) === 1 || @$parts[1] === "" ? "index" : $parts[1];
        $this->controller = $parts[0];
        $this->action = $action;
        if (is_callable(array($controllerToHandle, $action))) {
            $controllerToHandle->$action(@$parts[2]);
        } else {
            NotFoundController::getInstance()->index();
        }
    }
}
