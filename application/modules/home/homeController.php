<?php

namespace Tumic\Modules\Home;

use Tumic\Modules\Base\BaseController;

class HomeController extends BaseController
{
    public function index()
    {
        parent::render(__DIR__ . "/home.html.php");
    }
}
