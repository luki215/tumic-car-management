<?php

use Tumic\Modules\Vehicles\Vehicle; ?>
<div class="row">

    <div class="col-md-4 mb-4">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <span>Informace</span>
                <a href="../edit/<?php p($vehicle->id) ?>" class="btn btn-warning">Upravit</a>
            </div>
            <table class="table-2-cols">
                <tr>
                    <td>Typ</td>
                    <td><?php echo Vehicle::$types[$vehicle->type] ?></td>
                </tr>
                <tr>
                    <td>Název</td>
                    <td><?php p($vehicle->name) ?></td>
                </tr>
                <tr>
                    <td>VIN</td>
                    <td><?php printVIN($vehicle->VIN) ?></td>
                </tr>
                <tr>
                    <td>Barva</td>
                    <td><?php echo Vehicle::$colors[$vehicle->color] ?></td>
                </tr>

                <tr>
                    <td>Motor</td>
                    <td><?php p($vehicle->engine) ?></td>
                </tr>
                <tr>
                    <td>SPZ</td>
                    <td><?php p($vehicle->SPZ) ?></td>
                </tr>
                <tr>
                    <td>STK</td>
                    <td><?php p(dateTxt($vehicle->STK)) ?></td>
                </tr>
                <tr>
                    <td>Pojistka</td>
                    <td><?php p(dateTxt($vehicle->insurance)) ?></td>
                </tr>
                <tr>
                    <td>Tachometr</td>
                    <td><?php p($vehicle->tachometer) ?></td>
                </tr>
                <tr>
                    <td>Poznámka</td>
                    <td><?php p($vehicle->note) ?></td>
                </tr>
                <tr>
                    <td>Průměrně najeto kilometrů</td>
                    <td><?php p($vehicle->avg_kilometers) ?></td>
                </tr>
                <tr>
                    <td>Velikost kol</td>
                    <td><?php p($vehicle->tires_size) ?></td>
                </tr>
                <tr>
                    <td>Typ kol</td>
                    <td><?php p(Vehicle::$tireTypes[$vehicle->tires_type]) ?></td>
                </tr>
                <tr>
                    <td>Druh kol</td>
                    <td><?php p(Vehicle::$tireKinds[$vehicle->tires_kind]) ?></td>
                </tr>
                <tr>
                    <td>Značka kol</td>
                    <td><?php p($vehicle->tires_brand) ?></td>
                </tr>
                <tr>
                    <td>Vzorek</td>
                    <td><?php p($vehicle->tires_mm) ?></td>
                </tr>
                <tr>
                    <td>Archivováno</td>
                    <td><?php p(boolTxt($vehicle->archived)) ?></td>
                </tr>
            </table>
        </div>
    </div>
    <div class="col-md-8">
        <!-- Repairs -->
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <span>Opravy</span>
                <a href="../<?php p($vehicle->id) ?>/events/new/repair" class="btn btn-success">Nová</a>
            </div>
            <table class="table">
                <thead>
                    <tr>
                        <th>Poznámka</th>
                        <th>Stav km</th>
                        <th>Datum</th>
                        <th></th>
                    </tr>
                </thead>
                <?php foreach ($repairs as $repair) { ?>
                    <tr>
                        <td><?php p($repair->note) ?></td>
                        <td><?php p($repair->tachometer) ?></td>
                        <td><?php p(dateTxt($repair->date)) ?></td>
                        <td> <a href="../<?php p($vehicle->id) ?>/events/edit/<?php p($repair->id) ?>" class="btn btn-warning">Upravit</a></td>
                        <td>
                            <form method="post" action="../<?php p($vehicle->id) ?>/events/destroy/<?php p($repair->id) ?>">
                                <?php include(BASE_TEMPLATES . "form_controls/_csrf_token.html.php") ?>
                                <button class="btn btn-danger">Odstranit</button>
                            </form>
                        </td>
                    </tr>
                <?php } ?>
            </table>
        </div>

        <!-- Oil replacements -->
        <div class="card mt-4">
            <div class="card-header d-flex justify-content-between align-items-center">
                <span>Výměny oleje</span>
                <a href="../<?php p($vehicle->id) ?>/events/new/oil_replacement" class="btn btn-success">Nová</a>
            </div>
            <table class="table">
                <thead>
                    <tr>
                        <th>Poznámka</th>
                        <th>Stav km</th>
                        <th>Datum</th>
                        <th></th>
                    </tr>
                </thead>
                <?php foreach ($oil_replacements as $oil_replacement) { ?>
                    <tr>
                        <td><?php p($oil_replacement->note) ?></td>
                        <td><?php p($oil_replacement->tachometer) ?></td>
                        <td><?php p(dateTxt($oil_replacement->date)) ?></td>
                        <td> <a href="../<?php p($vehicle->id) ?>/events/destroy/<?php p($oil_replacement->id) ?>" class="btn btn-warning">Upravit</a></td>
                        <td>
                            <form method="post" action="../<?php p($vehicle->id) ?>/events/destroy/<?php p($oil_replacement->id) ?>">
                                <?php include(BASE_TEMPLATES . "form_controls/_csrf_token.html.php") ?>
                                <button class="btn btn-danger">Odstranit</button>
                            </form>
                        </td>
                    </tr>
                <?php } ?>
            </table>
        </div>
        <!-- Accidents -->
        <div class="card mt-4">
            <div class="card-header d-flex justify-content-between align-items-center">
                <span>Nehody</span>
                <a href="../<?php p($vehicle->id) ?>/events/new/accident" class="btn btn-success">Nová</a>
            </div>
            <table class="table">
                <thead>
                    <tr>
                        <th>Poznámka</th>
                        <th>Stav km</th>
                        <th>Datum</th>
                        <th></th>
                    </tr>
                </thead>
                <?php foreach ($accidents as $accidents) { ?>
                    <tr>
                        <td><?php p($accidents->note) ?></td>
                        <td><?php p($accidents->tachometer) ?></td>
                        <td><?php p(dateTxt($accidents->date)) ?></td>
                        <td> <a href="../<?php p($vehicle->id) ?>/events/edit/<?php p($accidents->id) ?>" class="btn btn-warning">Upravit</a></td>
                        <td>
                            <form method="post" action="../<?php p($vehicle->id) ?>/events/destroy/<?php p($accidents->id) ?>">
                                <?php include(BASE_TEMPLATES . "form_controls/_csrf_token.html.php") ?>
                                <button class="btn btn-danger">Odstranit</button>
                            </form>
                        </td>
                    </tr>
                <?php } ?>
            </table>
        </div>
    </div>

</div>