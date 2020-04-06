<?php

use Tumic\Modules\Vehicles\Vehicle; ?>


<div class="card">
    <div class="card-header">
        Základnní info
    </div>
    <div class="card-body">
        <!-- name -->
        <?php
        include_with_vars(
            BASE_TEMPLATES . "form_controls/_text.html.php",
            [
                "label" => "Název",
                "name" => "vehicle[name]"
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
                "options" => Vehicle::$types
            ]
        );
        ?>

        <!-- engine -->
        <?php
        include_with_vars(
            BASE_TEMPLATES . "form_controls/_text.html.php",
            [
                "label" => "Motor",
                "name" => "vehicle[engine]"
            ]
        );
        ?>

        <!-- VIN -->
        <?php
        include_with_vars(
            BASE_TEMPLATES . "form_controls/_text.html.php",
            [
                "label" => "VIN",
                "name" => "vehicle[VIN]"
            ]
        );
        ?>


        <!-- Photo -->
        <?php
        include_with_vars(
            BASE_TEMPLATES . "form_controls/_file.html.php",
            [
                "label" => "Fotka",
                "name" => "vehicle[photo]"
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
                "options" => Vehicle::$colors
            ]
        );
        ?>

        <!-- SPZ -->
        <?php
        include_with_vars(
            BASE_TEMPLATES . "form_controls/_text.html.php",
            [
                "label" => "SPZ",
                "name" => "vehicle[SPZ]"
            ]
        );
        ?>

        <!-- STK -->
        <?php
        include_with_vars(
            BASE_TEMPLATES . "form_controls/_date.html.php",
            [
                "label" => "STK",
                "name" => "vehicle[STK]"
            ]
        );
        ?>

        <!-- STK -->
        <?php
        include_with_vars(
            BASE_TEMPLATES . "form_controls/_date.html.php",
            [
                "label" => "Pojistka",
                "name" => "vehicle[insurance]"
            ]
        );
        ?>

        <!-- tachometer -->
        <?php
        include_with_vars(
            BASE_TEMPLATES . "form_controls/_number.html.php",
            [
                "label" => "Tachometr",
                "name" => "vehicle[tachometer]"
            ]
        );
        ?>

        <!-- note -->
        <?php
        include_with_vars(
            BASE_TEMPLATES . "form_controls/_textarea.html.php",
            [
                "label" => "Poznámka",
                "name" => "vehicle[note]"
            ]
        );
        ?>

        <!-- avg kilometers -->
        <?php
        include_with_vars(
            BASE_TEMPLATES . "form_controls/_number.html.php",
            [
                "label" => "Průměrně najeto kilometrů za měsíc",
                "name" => "vehicle[avg_kilometers]"
            ]
        );
        ?>

        <!-- archived -->
        <?php
        include_with_vars(
            BASE_TEMPLATES . "form_controls/_switch.html.php",
            [
                "label" => "Archivováno",
                "name" => "vehicle[archived]"
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
                "name" => "vehicle[tires_size]"
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
                "options" => Vehicle::$tireTypes
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
                "options" => Vehicle::$tireKinds
            ]
        );
        ?>

        <!-- tires brand -->
        <?php
        include_with_vars(
            BASE_TEMPLATES . "form_controls/_select.html.php",
            [
                "label" => "Typ",
                "name" => "vehicle[tires_kind]",
                "options" => Vehicle::$tireBrands
            ]
        );
        ?>

        <!-- tires mm -->
        <?php
        include_with_vars(
            BASE_TEMPLATES . "form_controls/_number.html.php",
            [
                "label" => "Vzorek(mm)",
                "name" => "vehicle[tires_mm]"
            ]
        );
        ?>
    </div>
</div>

<div class="mt-3 d-flex justify-content-between">
    <a href="./" class="btn btn-outline-secondary">Zpět</a>
    <button class="btn btn-success">Uložit</button>
</div>