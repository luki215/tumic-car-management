<?php

namespace Tumic\Modules\Vehicles\Events;

use Tumic\Lib\FlashMessages;
use Tumic\Modules\Base\BaseController;
use Tumic\Modules\Vehicles\Vehicle;

class VehiclesEventsController extends BaseController
{

    public function new($vehicle_id, $type)
    {
        $this->allowOnly("admin", "mechanic");
        $this->templateVars["vehicleId"] = $vehicle_id;

        switch ($type) {
            case "repair":
                parent::render(__DIR__ . '/templates/repair/new.html.php');
                break;
            case "oil_replacement":
                //parent::render(__DIR__ . '/templates/oil_replacement/new.html.php');
                break;
            case "accident":
                //parent::render(__DIR__ . '/templates/accident/new.html.php');
                break;
        };
    }

    public function create($vehicle_id)
    {
        $this->allowOnly("admin", "mechanic");
        $vehicleEvent_params = $_POST["vehicleEvent"];

        $vehicleEvent = new VehicleEvent($vehicleEvent_params);
        if ($vehicleEvent->save()) {
            FlashMessages::getInstance()->once("success", "Vozidlo bylo úspěšně vytvořeno");
            parent::redirect(ROOT . "/vehicles/show/" . $vehicle_id);
        } else {
            $this->templateVars["vehicleEvent"] = $vehicleEvent;
            $this->templateVars["vehicleId"] = $vehicle_id;
            FlashMessages::getInstance()->once("danger", "Chyba při vytváření");
            parent::render(__DIR__ . '/templates/repair/new.html.php');
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
