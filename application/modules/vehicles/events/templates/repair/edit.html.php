<h1>Upravit opravu</h1>

<form action="../update/<?php p($vehicleEvent->id) ?>" method="POST">
    <input type="hidden" name="vehicleEvent[id]" value="<?php p($vehicleEvent->id) ?>">
    <?php include __DIR__ . "/_form.html.php" ?>
</form>