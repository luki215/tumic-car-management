<?php

namespace Tumic\Modules\Base;

use Tumic\Config\Router;
use Tumic\Lib\ParamConverter;
use Tumic\Lib\Singleton;
use Tumic\Modules\Users\User;

abstract class BaseController
{
    use Singleton;
    public $templateVars = [
        "title" => "Tumič auta"
    ];

    public function beforeAction()
    {
        $this->templateVars['currentUser'] = User::get(@$_SESSION["user_id"]);
    }

    protected function render(string $templatePath)
    {
        include "helpers.php";
        extract($this->templateVars);

        $controller = Router::getInstance()->controller;
        $action = Router::getInstance()->action;

        include_once __DIR__ . "/baseTemplate.html.php";
    }

    protected function redirect(string $url)
    {
        header("Location: " . $url);
    }
};
