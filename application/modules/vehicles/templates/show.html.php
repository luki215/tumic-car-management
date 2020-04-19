<?php

use Tumic\Modules\Vehicles\Vehicle; ?>
<div class="row">

    <div class="col-md-4">
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
                    <td><?php p($vehicle->VIN) ?></td>
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
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <span>Opravy</span>
                <a href="../<?php p($vehicle->id) ?>/events/new/repair" class="btn btn-success">Nová</a>
            </div>
            <div class="card-body">
            </div>
        </div>
    </div>
</div>