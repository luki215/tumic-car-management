<?php

namespace Tumic\Modules\Base;

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
        include_once __DIR__ . "/baseTemplate.html.php";
    }
};
