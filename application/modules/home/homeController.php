<?php

namespace Tumic\Modules\Home;

use Tumic\Modules\Base\BaseController;

class HomeController extends BaseController
{
    public function index()
    {
        $this->allowOnly("confirmed");
        parent::render(__DIR__ . "/home.html.php");
    }
}
