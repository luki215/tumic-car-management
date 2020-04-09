<?php

namespace Tumic\Modules\Vehicles;

use Tumic\Lib\FlashMessages;
use Tumic\Modules\Base\BaseController;

class VehiclesController extends BaseController
{

    public function index()
    {
        $this->templateVars["vehicles"] = Vehicle::getAll();
        parent::render(__DIR__ . '/templates/index.html.php');
    }

    public function new()
    {
        parent::render(__DIR__ . '/templates/new.html.php');
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
            parent::render(__DIR__ . '/templates/new.html.php');
        }
    }

    public function edit($id)
    {
        $this->templateVars["vehicle"] = Vehicle::get($id);
        parent::render(__DIR__ . '/templates/edit.html.php');
    }

    public function update($id)
    {
        $vehicle_params = $_POST["vehicle"];
        $vehicle = new Vehicle($vehicle_params);
        $this->templateVars["vehicle"] = $vehicle;
        if ($vehicle->save()) {
            FlashMessages::getInstance()->once("success", "Vozidlo bylo úspěšně upraveno");
            parent::redirect(ROOT . "/vehicles");
        } else {
            FlashMessages::getInstance()->once("danger", "Chyba při úpravě");
            parent::render(__DIR__ . '/templates/edit.html.php');
        }
    }
}
