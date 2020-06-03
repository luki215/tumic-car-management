<input type="hidden" name="vehicleEvent[type]" value="3">
<input type="hidden" name="vehicleEvent[vehicle_id]" value="<?php p($vehicleId); ?>">
<?php include(BASE_TEMPLATES . "form_controls/_csrf_token.html.php") ?>

<?php
include_with_vars(
    BASE_TEMPLATES . "form_controls/_textarea.html.php",
    [
        "label" => "Popis",
        "name" => "vehicleEvent[note]",
        "value" => @$vehicleEvent->note,
        "conflict_value" => @$vehicleEvent_new->note,
        "error" => @$vehicleEvent->errors["note"]
    ]
);
?>

<!-- tachometer -->
<?php
include_with_vars(
    BASE_TEMPLATES . "form_controls/_number.html.php",
    [
        "label" => "Najeto kilometrů",
        "name" => "vehicleEvent[tachometer]",
        "value" => @$vehicleEvent->tachometer,
        "conflict_value" => @$vehicleEvent_new->tachometer,
        "error" => @$vehicleEvent->errors["tachometer"]
    ]
);
?>


<!-- date -->
<?php
include_with_vars(
    BASE_TEMPLATES . "form_controls/_date.html.php",
    [
        "label" => "Datum",
        "name" => "vehicleEvent[date]",
        "value" => @$vehicleEvent->date,
        "conflict_value" => @$vehicleEvent_new->date,
        "error" => @$vehicleEvent->errors["date"]
    ]
);
?>


<div class="mt-3 d-flex justify-content-between">
    <a href="<?php p(linkTo("/vehicles/show/" . $vehicleId)) ?>" class="btn btn-outline-secondary">Zpět</a>
    <button class="btn btn-success">Uložit</button>
</div>