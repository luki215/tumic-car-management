<?php

namespace Tumic\Modules\Todos;

use Tumic\Lib\FlashMessages;
use Tumic\Modules\Base\BaseController;


class TodosController extends BaseController
{
    public $fb;

    public function index()
    {
        $this->templateVars["todos"] = Todo::getAll();
        parent::render(__DIR__ . "/templates/index.html.php");
    }


    public function new()
    {
        parent::render(__DIR__ . '/templates/new.html.php');
    }

    public function create()
    {
        $todo_params = $_POST["todo"];
        $todo = new Todo($todo_params);
        $todo->assignee_id = $this->templateVars["currentUser"]->id;
        if ($todo->save()) {
            FlashMessages::getInstance()->once("success", "Úkol úspěšně vytvořen");
            parent::redirect(ROOT . "/todos");
        } else {
            $this->templateVars["todo"] = $todo;
            FlashMessages::getInstance()->once("danger", "Chyba při vytváření");
            parent::render(__DIR__ . '/templates/new.html.php');
        }
    }

    public function edit($id)
    {
        $this->templateVars["todo"] = Todo::get($id);
        parent::render(__DIR__ . '/templates/edit.html.php');
    }

    public function update($id)
    {
        $todo_params = $_POST["todo"];
        $todo = new Todo($todo_params);
        if ($todo->save()) {
            FlashMessages::getInstance()->once("success", "Úkol byl úspěšně upraven.");
            parent::redirect(ROOT . "/todos");
        } else {
            $this->templateVars["todo"] = $todo;
            FlashMessages::getInstance()->once("danger", "Chyba při úpravě");
            // parent::render(__DIR__ . '/templates/edit.html.php');
        }
    }

    public function destroy($id)
    {
        if (Todo::destroy($id)) {
            FlashMessages::getInstance()->once("success", "Úkol odstraněn.");
        } else {
            FlashMessages::getInstance()->once("danger", "Stala se chyba, zkuste to znova.");
        }
        parent::redirect(ROOT . "/todos/");
    }
}
