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
use Tumic\Modules\Vehicles\Events\VehiclesEventsController;

class Router
{
    use Singleton;
    public $controller;
    public $action;
    public function route(string $url)
    {
        $parts = explode('/', $url);
        // basic controller/:action/:id/ call
        if (count($parts) < 3 || @$parts[2] === "" || preg_match("/[0-9]+/", @$parts[2])) {
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
            $params = [@$parts[2]];
        }
        // subcontrollers (controller/:id/subcontroller/:action/:id)
        else {
            switch ($parts[0]) {
                case "vehicles":
                    switch ($parts[2]) {
                        case "events":
                            $controllerToHandle = VehiclesEventsController::getInstance();
                            break;
                        default:
                            $controllerToHandle = NotFoundController::getInstance();
                            break;
                    };
                    break;
                default:
                    $controllerToHandle = NotFoundController::getInstance();
                    break;
            }
            $action = (count($parts) === 3 || @$parts[3] === "") ? "index" : $parts[3];
            $params = [@$parts[1], @$parts[4]];
        }



        $this->controller = $parts[0];
        $this->action = $action;

        if (is_callable(array($controllerToHandle, $action))) {
            $controllerToHandle->beforeAction();
            call_user_func_array([$controllerToHandle, $action], $params);
            if (!$controllerToHandle->permissionsSet) {
                throw new Exception("Must set permissions for this action");
            }
        } else {
            NotFoundController::getInstance()->beforeAction();
            NotFoundController::getInstance()->index();
        }
    }
}
