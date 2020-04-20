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
                parent::render(__DIR__ . '/templates/oil_replacement/new.html.php');
                break;
            case "accident":
                parent::render(__DIR__ . '/templates/accident/new.html.php');
                break;
        };
    }

    public function create($vehicle_id)
    {
        $this->allowOnly("admin", "mechanic");
        $vehicleEvent_params = $_POST["vehicleEvent"];

        $vehicleEvent = new VehicleEvent($vehicleEvent_params);
        if ($vehicleEvent->save()) {
            FlashMessages::getInstance()->once("success", "Událost byla úspěšně vytvořena");
            parent::redirect(ROOT . "/vehicles/show/" . $vehicle_id);
        } else {
            $this->templateVars["vehicleEvent"] = $vehicleEvent;
            $this->templateVars["vehicleId"] = $vehicle_id;
            FlashMessages::getInstance()->once("danger", "Chyba při vytváření");
            parent::render(__DIR__ . '/templates/repair/new.html.php');
        }
    }

    public function edit($vehicle_id, $id)
    {
        $this->allowOnly("admin", "mechanic");
        $this->templateVars["vehicleEvent"] = VehicleEvent::get($id);
        $this->templateVars["vehicleId"] = $vehicle_id;

        switch ($this->templateVars["vehicleEvent"]->type) {
            case 1:
                parent::render(__DIR__ . '/templates/repair/edit.html.php');
                break;
            case 2:
                parent::render(__DIR__ . '/templates/oil_replacement/edit.html.php');
                break;
            case 3:
                parent::render(__DIR__ . '/templates/accident/edit.html.php');
                break;
        };
    }

    public function update($vehicle_id, $id)
    {
        $this->allowOnly("admin", "mechanic");
        $vehicleEvent_params = $_POST["vehicleEvent"];
        $vehicleEvent = new VehicleEvent($vehicleEvent_params);
        $this->templateVars["vehicleEvent"] = $vehicleEvent;
        $this->templateVars["vehicleId"] = $vehicle_id;
        if ($vehicleEvent->save()) {
            FlashMessages::getInstance()->once("success", "Údálost byla úspěšně upravena");
            parent::redirect(ROOT . "/vehicles/show/" . $vehicle_id);
        } else {
            FlashMessages::getInstance()->once("danger", "Chyba při úpravě");
            switch ($this->templateVars["vehicleEvent"]->type) {
                case 1:
                    parent::render(__DIR__ . '/templates/repair/edit.html.php');
                    break;
                case 2:
                    parent::render(__DIR__ . '/templates/oil_replacement/edit.html.php');
                    break;
                case 3:
                    parent::render(__DIR__ . '/templates/accident/edit.html.php');
                    break;
            };
        }
    }

    public function destroy($vehicle_id, $id)
    {
        $this->allowOnly("admin");
        if (VehicleEvent::destroy($id)) {
            FlashMessages::getInstance()->once("success", "Událost odstraněna.");
        } else {
            FlashMessages::getInstance()->once("danger", "Stala se chyba, zkuste to znova.");
        }
        parent::redirect(ROOT . "/vehicles/show/" . $vehicle_id);
    }
}
