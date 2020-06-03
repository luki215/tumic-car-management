<?php

namespace Tumic\Modules\Base;

use Exception;
use Tumic\Config\Router;
use Tumic\Lib\ParamConverter;
use Tumic\Lib\Singleton;
use Tumic\Modules\Users\User;
use Tumic\Lib\FlashMessages;


abstract class BaseController
{
    use Singleton;
    // to detect whether the permissions were set for the action
    public $permissionsSet = false;
    /**
     * @var $templateVars - variables accessible in templates
     */
    public $templateVars = [
        "title" => "Tumič auta"
    ];

    public function beforeAction()
    {
        $this->templateVars['currentUser'] = User::get(@$_SESSION["user_id"]);

        if (empty($_SESSION['token'])) {
            $_SESSION['token'] = bin2hex(random_bytes(32));
        }
        $this->templateVars["csrfToken"] = $_SESSION['token'];

        if (
            $_SERVER['REQUEST_METHOD'] === "POST" ||
            $_SERVER['REQUEST_METHOD'] === "PUT" ||
            $_SERVER['REQUEST_METHOD'] === "PATCH" ||
            $_SERVER['REQUEST_METHOD'] === "DELETE"
        ) {

            if (@$_REQUEST["csrfToken"] != $_SESSION['token']) {
                FlashMessages::getInstance()->once("danger", "Chyba v ověření bezpečnosti. Zkuste to prosím znovu.");
                $this->permissionsSet = true;
                $this->redirect(ROOT . "/");
            };
        }
    }

    /**
     * @var $role - which role has access
     *              roles:
     *                  "anonymous" = only users that are not logged in
     *                  "admin" = only administrators
     *                  "mechanic" = only mechanics
     *                  "secretary" = only secretaries
     *                  "not_confirmed" = only not confirmed users
     *                  "confirmed" = admin | mechanic | secretary
     *                  "logged" = admin | mechanic | secretary | not_confirmed
     *                  "all" = anyone
     */
    protected function allowOnly(...$allowed_roles)
    {
        $this->permissionsSet = true;

        if (in_array("all", $allowed_roles)) {
            return;
        }
        // transform helper roles to basic ones
        if (in_array("confirmed", $allowed_roles)) {
            array_push($allowed_roles, "admin", "mechanic", "secretary");
        }

        if (in_array("logged", $allowed_roles)) {
            array_push($allowed_roles, "admin", "mechanic", "secretary", "not_confirmed");
        }



        // tranform current user role to our keys
        $current_user = $this->templateVars['currentUser'];
        if ($current_user === null) {
            $user_role = "anonymous";
        } else {
            switch ($current_user->role) {
                case "1":
                    $user_role = "admin";
                    break;
                case "2":
                    $user_role = "mechanic";
                    break;
                case "3":
                    $user_role = "secretary";
                    break;
                case "4":
                    $user_role = "not_confirmed";
                    break;
                default:
                    $user_role = "not_confirmed";
                    break;
            }
        }


        // if not permitted, redirect to corresponding page
        if (!in_array($user_role, $allowed_roles)) {
            // not logged users to login
            if ($current_user === null) {
                $this->redirect(ROOT . "/users/login/");
            } else {
                // others to not allowed
                $this->redirect(ROOT . "/notAllowed/");
            }
        }
    }

    protected function render(string $templatePath)
    {
        if (!$this->permissionsSet) {
            throw new Exception("Must set permissions for this action");
        }

        include_once "helpers.php";
        extract($this->templateVars);

        $controller = Router::getInstance()->controller;
        $action = Router::getInstance()->action;

        include_once __DIR__ . "/baseTemplate.html.php";
    }

    protected function redirect(string $url)
    {
        if (!$this->permissionsSet) {
            throw new Exception("Must set permissions for this action");
        }
        header("Location: " . $url);
        exit();
    }
};
