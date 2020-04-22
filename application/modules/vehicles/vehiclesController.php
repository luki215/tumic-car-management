<?php

namespace Tumic\Modules\Vehicles;

use Tumic\Lib\FlashMessages;
use Tumic\Modules\Base\BaseController;
use Tumic\Modules\Vehicles\Events\VehicleEvent;

class VehiclesController extends BaseController
{

    public function index()
    {
        $this->allowOnly("confirmed");
        $this->templateVars["vehicles"] = Vehicle::getAll();
        parent::render(__DIR__ . '/templates/index.html.php');
    }

    public function show($id)
    {
        $this->allowOnly("confirmed");
        $this->templateVars["vehicle"] = Vehicle::get($id);
        $this->templateVars["repairs"] = VehicleEvent::getByType($id, 1);
        $this->templateVars["oil_replacements"] = VehicleEvent::getByType($id, 2);
        $this->templateVars["accidents"] = VehicleEvent::getByType($id, 3);
        parent::render(__DIR__ . '/templates/show.html.php');
    }

    public function new()
    {
        $this->allowOnly("admin", "mechanic");
        parent::render(__DIR__ . '/templates/new.html.php');
    }

    public function create()
    {
        $this->allowOnly("admin", "mechanic");
        $vehicle_params = $_POST["vehicle"];
        $vehicle = new Vehicle($vehicle_params);
        if ($vehicle->save()) {
            FlashMessages::getInstance()->once("success", "Vozidlo bylo úspěšně vytvořeno");
            parent::redirect(ROOT . "/vehicles/");
        } else {
            $this->templateVars["vehicle"] = $vehicle;
            FlashMessages::getInstance()->once("danger", "Chyba při vytváření");
            parent::render(__DIR__ . '/templates/new.html.php');
        }
    }

    public function edit($id)
    {
        $this->allowOnly("admin", "mechanic");
        $this->templateVars["vehicle"] = Vehicle::get($id);
        parent::render(__DIR__ . '/templates/edit.html.php');
    }

    public function update($id)
    {
        $this->allowOnly("admin", "mechanic");
        $vehicle_params = $_POST["vehicle"];
        $vehicle = new Vehicle($vehicle_params);
        $this->templateVars["vehicle"] = $vehicle;
        if ($vehicle->save()) {
            FlashMessages::getInstance()->once("success", "Vozidlo bylo úspěšně upraveno");
            parent::redirect(ROOT . "/vehicles/");
        } else {
            var_dump($vehicle->errors);

            FlashMessages::getInstance()->once("danger", "Chyba při úpravě");
            parent::render(__DIR__ . '/templates/edit.html.php');
        }
    }

    public function destroy($id)
    {
        $this->allowOnly("admin");
        if (Vehicle::destroy($id)) {
            FlashMessages::getInstance()->once("success", "Vozidlo odstraněno.");
        } else {
            FlashMessages::getInstance()->once("danger", "Stala se chyba, zkuste to znova.");
        }
        parent::redirect(ROOT . "/vehicles/");
    }
}
