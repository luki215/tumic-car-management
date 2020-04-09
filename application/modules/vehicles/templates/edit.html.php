<h1>Upravit vozidlo</h1>

<form action="../update/<?php p($vehicle->id); ?>" method="POST">
    <input type="hidden" name="vehicle[id]" value="<?php p($vehicle->id); ?>">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <?php include __DIR__ . "/_form.html.php"; ?>
        </div>
    </div>
</form>