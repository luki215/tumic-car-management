<?php

use Tumic\Modules\Todos\Todo;
use Tumic\Modules\Users\User;
use Tumic\Modules\Vehicles\Vehicle;

?>
<div class="d-flex justify-content-between align-items-center mb-1">
    <h1 class="mb-0">Úkoly</h1>
    <a href="./new" class=" btn btn-success">
        <i class="fa fa-plus"></i> Nový úkol
    </a>
</div>

<div class="row">
    <div class="col-md-4">
        <div class="card">
            <div class="card-header">
                Filtry
            </div>
            <div class="card-body">
                <form>
                    <!-- assigned_id -->
                    <?php
                    include_with_vars(
                        BASE_TEMPLATES . "form_controls/_multiselect.html.php",
                        [
                            "label" => "Přiřazená osoba",
                            "name" => "assigned_id",
                            "multi" => true,
                            "options" => User::getAllOptions(),
                            "value" => @$_GET["assigned_id"]
                        ]
                    );
                    ?>

                    <!-- priority -->
                    <?php
                    include_with_vars(
                        BASE_TEMPLATES . "form_controls/_multiselect.html.php",
                        [
                            "label" => "Priorita",
                            "name" => "priority",
                            "multi" => true,
                            "options" => Todo::$priorities,
                            "value" => @$_GET["priority"]
                        ]
                    );
                    ?>

                    <!-- state -->
                    <?php
                    include_with_vars(
                        BASE_TEMPLATES . "form_controls/_multiselect.html.php",
                        [
                            "label" => "Stav",
                            "name" => "state",
                            "options" => Todo::$states,
                            "value" => @$_GET["state"]
                        ]
                    );
                    ?>

                    <!-- vehicle -->
                    <?php
                    include_with_vars(
                        BASE_TEMPLATES . "form_controls/_multiselect.html.php",
                        [
                            "label" => "Přiřazené vozidlo",
                            "name" => "vehicle_id",
                            "options" => array_merge(Vehicle::getAllOptions(), ["null" => "Nepřiřazeno"]),
                            "value" => @$_GET["vehicle_id"]
                        ]
                    );
                    ?>
                </form>
            </div>
        </div>
    </div>
    <div class="col-md-8">
        <div class="table-responsive">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Stav</th>
                        <th>Deadline</th>
                        <th>Priorita</th>
                        <th>Přiřazená osoba</th>
                        <th>Přiřazené vozidlo</th>
                        <th>Zadavatel</th>
                        <th>Vytvořeno</th>
                        <th>Text</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    foreach ($todos as $todo) { ?>
                        <tr>
                            <td><?php p(Todo::$states[$todo->state]) ?></td>
                            <td><?php p(dateTxt($todo->deadline)) ?></td>
                            <td><?php p(Todo::$priorities[$todo->priority]) ?></td>
                            <td><?php p($todo->assigned_name) ?></td>
                            <td>
                                <?php if ($todo->vehicle_id) {
                                    p($todo->vehicle_name . " (" . $todo->vehicle_spz . ")");
                                } else {
                                    p("Nepřiřazeno");
                                }
                                ?>
                            </td>
                            <td><?php p($todo->assignee_name) ?></td>
                            <td><?php p(dateTxt($todo->created_at)) ?></td>
                            <td><?php p($todo->text) ?></td>
                            <td><a href="<?php p(linkTo("/todos/edit/" . $todo->id)) ?>" class="btn btn-warning">Upravit</a></td>
                            <td><a href="<?php p(linkTo("/todos/destroy/" . $todo->id)) ?>" class="btn btn-danger">Odstranit</a></td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<div class="row mt-3">
    <div class="col d-flex justify-content-center">
        <?php include BASE_TEMPLATES . "/pagination.html.php" ?>
    </div>
</div>

<script>
    $(function() {
        var $roleSelects = $("form select");

        $roleSelects.change(function() {
            $(this).closest("form").submit();
        });

    });
</script>