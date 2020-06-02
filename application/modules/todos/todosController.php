<?php

namespace Tumic\Modules\Todos;

use Tumic\Lib\FlashMessages;
use Tumic\Modules\Base\BaseController;

class TodosController extends BaseController
{
    public $fb;

    public function index()
    {

        /**
         * Returns only array entries listed in a whitelist
         *
         * @param array $array original array to operate on
         * @param array $whitelist keys you want to keep
         * @return array
         */
        function arrayWhitelist($array, $whitelist)
        {
            return array_intersect_key(
                $array,
                array_flip($whitelist)
            );
        }

        $this->allowOnly("confirmed");
        $filterParams = arrayWhitelist($_GET, ["assigned_id", "priority", "state", "vehicle_id"]);

        $this->templateVars["todos"] = Todo::getAllBy($filterParams);
        parent::render(__DIR__ . "/templates/index.html.php");
    }


    public function new()
    {
        $this->allowOnly("admin", "mechanic");
        $this->templateVars["todo"] = new Todo(["state" => "1", "priority" => 3]);
        parent::render(__DIR__ . '/templates/new.html.php');
    }

    public function create()
    {
        $this->allowOnly("admin", "mechanic");
        $todo_params = $_POST["todo"];
        $todo = new Todo($todo_params);
        $todo->assignee_id = $this->templateVars['currentUser']->id;
        if ($todo->save()) {
            FlashMessages::getInstance()->once("success", "Úkol úspěšně vytvořen");
            parent::redirect(ROOT . "/todos/");
        } else {
            $this->templateVars["todo"] = $todo;
            FlashMessages::getInstance()->once("danger", "Chyba při vytváření");
            parent::render(__DIR__ . '/templates/new.html.php');
        }
    }

    public function edit($id)
    {
        $this->allowOnly("admin", "mechanic");
        $this->templateVars["todo"] = Todo::get($id);
        parent::render(__DIR__ . '/templates/edit.html.php');
    }

    public function update($id)
    {
        $this->allowOnly("admin", "mechanic");
        $todo_params = @$_POST["todo"];
        if (!$todo_params) {
            parent::redirect(ROOT . "/todos/edit/" . $id);
        }
        $todo = new Todo($todo_params);
        if ($todo->save()) {
            FlashMessages::getInstance()->once("success", "Úkol byl úspěšně upraven.");
            parent::redirect(ROOT . "/todos/");
        } else {
            $todo_new = @$todo->errors["race_condition"];
            if ($todo_new) {
                $this->templateVars["todo_new"] = $todo_new;
                FlashMessages::getInstance()->once("danger", "Někdo jiný mezitím upravil tuto položku.");
            }
            $this->templateVars["todo"] = $todo;
            FlashMessages::getInstance()->once("danger", "Chyba při úpravě");
            parent::render(__DIR__ . '/templates/edit.html.php');
        }
    }

    public function destroy($id)
    {
        $this->allowOnly("admin", "mechanic");
        if (Todo::destroy($id)) {
            FlashMessages::getInstance()->once("success", "Úkol odstraněn.");
        } else {
            FlashMessages::getInstance()->once("danger", "Stala se chyba, zkuste to znova.");
        }
        parent::redirect(ROOT . "/todos/");
    }
}
