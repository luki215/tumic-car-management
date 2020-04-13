<?php

namespace Tumic\Modules\Users;

use Exception;
use Tumic\Lib\FlashMessages;
use Tumic\Modules\Base\BaseController;
use Tumic\Modules\Users\User;

class UsersController extends BaseController
{
    public $fb;

    public function __construct()
    {
        $this->fb = new \Facebook\Facebook([
            'app_id' => FB_APP_ID,
            'app_secret' => FB_APP_SECRET,
            'default_graph_version' => 'v2.2',
        ]);
    }

    public function index()
    {
        $this->templateVars["users"] = User::getAll();
        parent::render(__DIR__ . "/templates/index.html.php");
    }

    public function updateRole($id)
    {
        $user = User::get($id);
        $user->role = $_POST["user"]["role"];
        if ($user->save()) {
            FlashMessages::getInstance()->once("success", "Role upravena úspěšně.");
        } else {
            FlashMessages::getInstance()->once("danger", "Něco se nepovedlo, zkuste znovu.");
        }
        parent::redirect(ROOT . "/users/");
    }

    public function destroy($id)
    {
        if (User::destroy($id)) {
            FlashMessages::getInstance()->once("success", "Uživatel odstraněn.");
        } else {
            FlashMessages::getInstance()->once("danger", "Stala se chyba, zkuste to znova.");
        }
        parent::redirect(ROOT . "/users/");
    }

    public function login()
    {
        $helper = $this->fb->getRedirectLoginHelper();

        $permissions = []; // Optional permissions
        $this->templateVars["loginUrl"] = $helper->getLoginUrl(ROOT . '/users/loginCallback', $permissions);
        parent::render(__DIR__ . "/templates/login.html.php");
    }

    public function loginCallback()
    {

        $helper = $this->fb->getRedirectLoginHelper();

        try {
            $accessToken = $helper->getAccessToken();

            // The OAuth 2.0 client handler helps us manage access tokens
            $oAuth2Client = $this->fb->getOAuth2Client();

            if (!$accessToken->isLongLived()) {
                // Exchanges a short-lived access token for a long-lived one
                $accessToken = $oAuth2Client->getLongLivedAccessToken($accessToken);
            }

            // Returns a `Facebook\FacebookResponse` object
            $response = $this->fb->get('/me?fields=id,name', $accessToken);

            $user = $response->getGraphUser();

            $db_user = User::getByFBId($user["id"]);

            // user not exist => create
            if ($db_user === null) {
                $db_user = new User(["fb_id" => $user["id"], "name" => $user["name"], "role" => "4"]);

                $res = $db_user->save();
                if ($res) {
                    $_SESSION['user_id'] = $db_user->id;
                    FlashMessages::getInstance()->once("success", "Přihlášení úspěšné.");
                    parent::redirect(ROOT . "/");
                } else {
                    FlashMessages::getInstance()->once("danger", "Chyba v přihlášení. Zkuste to prosím znovu.");
                    parent::redirect(ROOT . "/users/login");
                }
            } else {
                // user exists
                $_SESSION['user_id'] = $db_user->id;
                FlashMessages::getInstance()->once("success", "Přihlášení úspěšné.");
                parent::redirect(ROOT . "/");
            }
        } catch (Exception $e) {
            FlashMessages::getInstance()->once("danger", "Chyba v přihlášení. Zkuste to prosím znovu.");
            parent::redirect(ROOT . "/users/login");
        }
    }
}
