<?php

use Tumic\Modules\Vehicles\Vehicle; ?>
<?php include(BASE_TEMPLATES . "form_controls/_csrf_token.html.php") ?>


<div class="card">
    <div class="card-header">
        Základnní info
    </div>
    <div class="card-body">
        <?php if ($vehicle->id) { ?>
            <input type="hidden" name="vehicle[updated_at]" value="<?php p(@$vehicle->updated_at) ?>">
        <?php } ?>
        <!-- name -->
        <?php
        include_with_vars(
            BASE_TEMPLATES . "form_controls/_text.html.php",
            [
                "label" => "Název",
                "name" => "vehicle[name]",
                "value" => @$vehicle->name,
                "conflict_value" => @$vehicle_new->name,
                "error" => @$vehicle->errors["name"]
            ]
        );
        ?>

        <!-- type -->
        <?php
        include_with_vars(
            BASE_TEMPLATES . "form_controls/_select.html.php",
            [
                "label" => "Druh",
                "name" => "vehicle[type]",
                "options" => Vehicle::$types,
                "value" => @$vehicle->type,
                "conflict_value" => @$vehicle_new->type,
                "error" => @$vehicle->errors["type"]
            ]
        );
        ?>

        <!-- engine -->
        <?php
        include_with_vars(
            BASE_TEMPLATES . "form_controls/_text.html.php",
            [
                "label" => "Motor",
                "name" => "vehicle[engine]",
                "value" => @$vehicle->engine,
                "conflict_value" => @$vehicle_new->engine,
                "error" => @$vehicle->errors["engine"]
            ]
        );
        ?>

        <!-- VIN -->
        <?php
        include_with_vars(
            BASE_TEMPLATES . "form_controls/_text.html.php",
            [
                "label" => "VIN",
                "name" => "vehicle[VIN]",
                "value" => @$vehicle->VIN,
                "conflict_value" => @$vehicle_new->VIN,
                "error" => @$vehicle->errors["VIN"]
            ]
        );
        ?>

        <!-- Color -->
        <?php
        include_with_vars(
            BASE_TEMPLATES . "form_controls/_select.html.php",
            [
                "label" => "Barva",
                "name" => "vehicle[color]",
                "options" => Vehicle::$colors,
                "value" => @$vehicle->color,
                "conflict_value" => @$vehicle_new->color,
                "error" => @$vehicle->errors["color"]
            ]
        );
        ?>

        <!-- SPZ -->
        <?php
        include_with_vars(
            BASE_TEMPLATES . "form_controls/_text.html.php",
            [
                "label" => "SPZ",
                "name" => "vehicle[SPZ]",
                "value" => @$vehicle->SPZ,
                "conflict_value" => @$vehicle_new->SPZ,
                "error" => @$vehicle->errors["SPZ"]
            ]
        );
        ?>

        <!-- STK -->
        <?php
        include_with_vars(
            BASE_TEMPLATES . "form_controls/_date.html.php",
            [
                "label" => "STK",
                "name" => "vehicle[STK]",
                "value" => @$vehicle->STK,
                "conflict_value" => @$vehicle_new->STK,
                "error" => @$vehicle->errors["STK"]
            ]
        );
        ?>

        <!-- insurance -->
        <?php
        include_with_vars(
            BASE_TEMPLATES . "form_controls/_date.html.php",
            [
                "label" => "Pojistka",
                "name" => "vehicle[insurance]",
                "value" => @$vehicle->insurance,
                "conflict_value" => @$vehicle_new->insurance,
                "error" => @$vehicle->errors["insurance"]
            ]
        );
        ?>

        <!-- tachometer -->
        <?php
        include_with_vars(
            BASE_TEMPLATES . "form_controls/_number.html.php",
            [
                "label" => "Tachometr",
                "name" => "vehicle[tachometer]",
                "value" => @$vehicle->tachometer,
                "conflict_value" => @$vehicle_new->tachometer,
                "error" => @$vehicle->errors["tachometer"]
            ]
        );
        ?>

        <!-- note -->
        <?php
        include_with_vars(
            BASE_TEMPLATES . "form_controls/_textarea.html.php",
            [
                "label" => "Poznámka",
                "name" => "vehicle[note]",
                "value" => @$vehicle->note,
                "conflict_value" => @$vehicle_new->note,
                "error" => @$vehicle->errors["note"]
            ]
        );
        ?>

        <!-- avg kilometers -->
        <?php
        include_with_vars(
            BASE_TEMPLATES . "form_controls/_number.html.php",
            [
                "label" => "Průměrně najeto kilometrů za měsíc",
                "name" => "vehicle[avg_kilometers]",
                "value" => @$vehicle->avg_kilometers,
                "conflict_value" => @$vehicle_new->avg_kilometers,
                "error" => @$vehicle->errors["avg_kilometers"]
            ]
        );
        ?>

        <!-- archived -->
        <?php
        include_with_vars(
            BASE_TEMPLATES . "form_controls/_switch.html.php",
            [
                "label" => "Archivováno",
                "name" => "vehicle[archived]",
                "value" => @$vehicle->archived,
                "conflict_value" => @$vehicle_new->archived,
                "error" => @$vehicle->errors["archived"]
            ]
        );
        ?>
    </div>
</div>

<div class="card mt-3">
    <div class="card-header">
        Pneumatiky
    </div>
    <div class="card-body">

        <!-- tires size -->
        <?php
        include_with_vars(
            BASE_TEMPLATES . "form_controls/_number.html.php",
            [
                "label" => "Velikost",
                "name" => "vehicle[tires_size]",
                "value" => @$vehicle->tires_size,
                "error" => @$vehicle->errors["tires_size"]
            ]
        );
        ?>

        <!-- tires type -->
        <?php
        include_with_vars(
            BASE_TEMPLATES . "form_controls/_select.html.php",
            [
                "label" => "Typ",
                "name" => "vehicle[tires_type]",
                "options" => Vehicle::$tireTypes,
                "value" => @$vehicle->tires_type,
                "error" => @$vehicle->errors["tires_type"]
            ]
        );
        ?>

        <!-- tires kind -->
        <?php
        include_with_vars(
            BASE_TEMPLATES . "form_controls/_select.html.php",
            [
                "label" => "Typ",
                "name" => "vehicle[tires_kind]",
                "options" => Vehicle::$tireKinds,
                "value" => @$vehicle->tires_kind,
                "error" => @$vehicle->errors["tires_kind"]
            ]
        );
        ?>

        <!-- tires brand -->
        <?php
        include_with_vars(
            BASE_TEMPLATES . "form_controls/_select.html.php",
            [
                "label" => "Typ",
                "name" => "vehicle[tires_brand]",
                "options" => Vehicle::$tireBrands,
                "value" => @$vehicle->tires_brand,
                "error" => @$vehicle->errors["tires_brand"]
            ]
        );
        ?>

        <!-- tires mm -->
        <?php
        include_with_vars(
            BASE_TEMPLATES . "form_controls/_number.html.php",
            [
                "label" => "Vzorek(mm)",
                "name" => "vehicle[tires_mm]",
                "value" => @$vehicle->tires_mm,
                "error" => @$vehicle->errors["tires_mm"]
            ]
        );
        ?>
    </div>
</div>

<div class="mt-3 d-flex justify-content-between">
    <a href="<?php p(linkTo("/vehicles/")) ?>" class="btn btn-outline-secondary">Zpět</a>
    <button class="btn btn-success">Uložit</button>
</div>