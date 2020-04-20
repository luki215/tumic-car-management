<h1>Upravit nehodu</h1>

<form action="../update/" method="POST">
    <input type="hidden" name="vehicleEvent[id]" value="<?php p($vehicleEvent->id) ?>">
    <?php include __DIR__ . "/_form.html.php" ?>
</form>