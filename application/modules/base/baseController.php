<?php

namespace Tumic\Modules\Base;

use Tumic\Config\Router;
use Tumic\Lib\Singleton;

abstract class BaseController
{
    use Singleton;
    public $templateVars = [
        "title" => "Tumič auta"
    ];
    protected function render(string $templatePath)
    {
        include "helpers.php";
        extract($this->templateVars);

        $controller = Router::getInstance()->controller;
        $action = Router::getInstance()->action;

        include_once __DIR__ . "/baseTemplate.html.php";
    }
};
