<?php

use Tumic\Modules\Vehicles\Vehicle;
?>
<div class="row">
    <div class="col-md-6">
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

        <!-- $type, $avg_kilometers, $tires_size, $tires_type, $tires_kind, $tires_brand,
$tires_mm, $archived, $updated_at;
-->




    </div>
    <div class="col-md-6"></div>
</div>
<a href="./" class="btn btn-outline-secondary">Zpět</a>
<button class="btn btn-success">Potvrdit</button>