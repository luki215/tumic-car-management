<h1>Upravit opravu</h1>

<form action="../update/<?php p($vehicleEvent->id) ?>" method="POST">
    <input type="hidden" name="vehicleEvent[id]" value="<?php p($vehicleEvent->id) ?>">
    <input type="hidden" name="vehicleEvent[updated_at]" value="<?php p(@$vehicleEvent->updated_at) ?>">

    <?php include __DIR__ . "/_form.html.php" ?>
</form>