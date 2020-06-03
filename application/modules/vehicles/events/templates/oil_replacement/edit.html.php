<h1>Upravit výměnu oleje</h1>

<form action="../update/" method="POST">
    <input type="hidden" name="vehicleEvent[id]" value="<?php p($vehicleEvent->id) ?>">
    <input type="hidden" name="vehicleEvent[updated_at]" value="<?php p(@$vehicleEvent->updated_at) ?>">
    <?php include __DIR__ . "/_form.html.php" ?>
</form>