<?php

namespace Tumic\Config;

use Exception;
use Tumic\Lib\Singleton;
use Tumic\Modules\Home\HomeController;
use Tumic\Modules\NotAllowed\NotAllowedController;
use Tumic\Modules\Vehicles\VehiclesController;
use Tumic\Modules\NotFound\NotFoundController;
use Tumic\Modules\Todos\TodosController;
use Tumic\Modules\Users\UsersController;

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
            case "":
                $controllerToHandle = HomeController::getInstance();
                break;
            case "vehicles":
                $controllerToHandle = VehiclesController::getInstance();
                break;
            case "users":
                $controllerToHandle = UsersController::getInstance();
                break;
            case "todos":
                $controllerToHandle = TodosController::getInstance();
                break;
            case "notAllowed":
                $controllerToHandle = NotAllowedController::getInstance();
                break;
            default:
                $controllerToHandle = NotFoundController::getInstance();
                break;
        }

        $action = count($parts) === 1 || @$parts[1] === "" ? "index" : $parts[1];
        $this->controller = $parts[0];
        $this->action = $action;

        if (is_callable(array($controllerToHandle, $action))) {
            $controllerToHandle->beforeAction();
            $controllerToHandle->$action(@$parts[2]);
            if (!$controllerToHandle->permissionsSet) {
                throw new Exception("Must set permissions for this action");
            }
        } else {
            NotFoundController::getInstance()->index();
        }
    }
}
