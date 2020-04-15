<h1>Úprava úkolu</h1>
<form action="../update/<?php p($todo->id) ?>" method="POST">
    <input type="hidden" name="todo[id]" value="<?php p($todo->id) ?>">
    <input type="hidden" name="todo[assignee_id]" value="<?php p($todo->assignee_id) ?>">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <?php include __DIR__ . "/_form.html.php"; ?>
        </div>
    </div>
</form>