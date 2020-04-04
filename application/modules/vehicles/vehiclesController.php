<?php

namespace Tumic\Modules\Vehicles;

use Tumic\Modules\Base\BaseController;

class VehiclesController extends BaseController
{

    public function index()
    {

        $this->templateVars["title"] = "Auta | " . $this->templateVars["title"];
        $this->templateVars["user"] = "1234";

        parent::render(__DIR__ . '/templates/index.html.php');
    }
}
