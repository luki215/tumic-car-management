<?php

use Tumic\Modules\Todos\Todo;
use Tumic\Modules\Users\User;
use Tumic\Modules\Vehicles\Vehicle;

?>

<?php if ($todo->id) { ?>
    <input type="hidden" name="todo[updated_at]" value="<?php p(@$todo->updated_at) ?>">
<?php } ?>

<?php include(BASE_TEMPLATES . "form_controls/_csrf_token.html.php") ?>

<div class="card mt-3">
    <div class="card-header">
        Todo
    </div>
    <div class="card-body">

        <!-- tires size -->
        <?php


        include_with_vars(
            BASE_TEMPLATES . "form_controls/_textarea.html.php",
            [
                "label" => "Text",
                "name" => "todo[text]",
                "value" => @$todo->text,
                "conflict_value" => @$todo_new->text,
                "error" => @$todo->errors["text"]
            ]
        );
        ?>

        <!-- deadline -->
        <?php
        include_with_vars(
            BASE_TEMPLATES . "form_controls/_date.html.php",
            [
                "label" => "Deadline",
                "name" => "todo[deadline]",
                "value" => @$todo->deadline,
                "error" => @$todo->errors["deadline"]
            ]
        );
        ?>


        <!-- state -->
        <?php
        include_with_vars(
            BASE_TEMPLATES . "form_controls/_select.html.php",
            [
                "label" => "Stav",
                "name" => "todo[state]",
                "options" => Todo::$states,
                "value" => @$todo->state,
                "conflict_value" => @$todo_new->state,
                "error" => @$todo->errors["state"]
            ]
        );
        ?>

        <!-- priority -->
        <?php
        include_with_vars(
            BASE_TEMPLATES . "form_controls/_select.html.php",
            [
                "label" => "Priorita",
                "name" => "todo[priority]",
                "options" => Todo::$priorities,
                "value" => @$todo->priority,
                "conflict_value" => @$todo_new->priority,
                "error" => @$todo->errors["priority"]
            ]
        );
        ?>


        <!-- vehicle_id -->
        <?php
        include_with_vars(
            BASE_TEMPLATES . "form_controls/_select.html.php",
            [
                "label" => "Vozidlo",
                "name" => "todo[vehicle_id]",
                "options" => Vehicle::getAllOptions(),
                "value" => @$todo->vehicle_id,
                "conflict_value" => @$todo_new->vehicle_id,
                "error" => @$todo->errors["vehicle_id"]
            ]
        );
        ?>
        <!-- assigned_id -->
        <?php
        include_with_vars(
            BASE_TEMPLATES . "form_controls/_select.html.php",
            [
                "label" => "Přiřazená osoba",
                "name" => "todo[assigned_id]",
                "options" => User::getAllOptions(),
                "value" => @$todo->assigned_id,
                "conflict_value" => @$todo_new->assigned_id,
                "error" => @$todo->errors["assigned_id"]
            ]
        );
        ?>
    </div>
</div>

<div class="mt-3 d-flex justify-content-between">
    <a href="<?php p(linkTo("/todos/")) ?>" class="btn btn-outline-secondary">Zpět</a>
    <button class="btn btn-success">Uložit</button>
</div>