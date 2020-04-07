<?php

namespace Tumic\Modules\Vehicles;

use Tumic\Lib\FlashMessages;
use Tumic\Modules\Base\BaseController;

class VehiclesController extends BaseController
{

    public function index()
    {

        $this->templateVars["title"] = "Auta | " . $this->templateVars["title"];
        $this->templateVars["vehicles"] = Vehicle::getAllByType("car");
        parent::render(__DIR__ . '/templates/index.html.php');
    }

    public function new()
    {
        parent::render(__DIR__ . '/templates/new.php');
    }

    public function create()
    {
        $vehicle_params = $_POST["vehicle"];
        $vehicle = new Vehicle($vehicle_params);
        if ($vehicle->save()) {
            FlashMessages::getInstance()->once("success", "Vozidlo bylo úspěšně vytvořeno");
            parent::redirect(ROOT . "/vehicles");
        } else {
            $this->templateVars["vehicle"] = $vehicle;
            FlashMessages::getInstance()->once("danger", "Chyba při vytváření");
            parent::render(__DIR__ . '/templates/new.php');
        }
    }
}
