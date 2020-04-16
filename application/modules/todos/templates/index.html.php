<?php

use Tumic\Modules\Todos\Todo;
use Tumic\Modules\Users\User;
?>
<div class="d-flex justify-content-between align-items-center mb-1">
    <h1 class="mb-0">Úkoly</h1>
    <a href="./new" class=" btn btn-success">
        <i class="fa fa-plus"></i> Nový úkol
    </a>
</div>

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
                    <td><?php p($todo->assignee_name) ?></td>
                    <td><?php p($todo->vehicle_name . " (" . $todo->vehicle_spz . ")") ?></td>
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
<script>
    $(function() {
        var $roleSelects = $(".roleForm select");

        $roleSelects.change(function() {
            $(this).closest("form").submit();
        });

    });
</script>