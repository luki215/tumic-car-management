<?php

use Tumic\Modules\Vehicles\Vehicle;
?>
<div class="d-flex justify-content-between align-items-center mb-1">
    <h1 class="mb-0">Vozidla</h1>
    <a href="./new" class=" btn btn-success">
        <i class="fa fa-plus"></i> Nové vozidlo
    </a>
</div>

<div class="table-responsive">
    <table class="table table-striped">
        <thead>
            <tr>
                <th></th>
                <th>Typ</th>
                <th>Název</th>
                <th>VIN</th>
                <th>Barva</th>
                <th>Motor</th>
                <th>SPZ</th>
                <th>STK</th>
                <th>Pojistka</th>
                <th>Tachometr</th>
                <th>Poznámka</th>
                <th>Průměrně km/měsíc</th>
                <th>Velikost pneumatik</th>
                <th>Typ pneumatik</th>
                <th>Druh pneumatik</th>
                <th>Značka pneumatik</th>
                <th>Vzorek pneumatik</th>
                <th>Archovováno</th>
            </tr>
        </thead>
        <tbody>
            <?php
            foreach ($vehicles as $vehicle) { ?>
                <tr class="<?php echo $vehicle->archived ? "text-decoration-through table-dark" : "" ?>">
                    <td>
                        <a href="./edit/<?php p($vehicle->id) ?>" class="btn btn-info">Detail</a>
                        <a href="./destroy/<?php p($vehicle->id) ?>" class="btn btn-danger">Odstranit</a>
                    </td>
                    <td><?php echo Vehicle::$types[$vehicle->type] ?></td>
                    <td><?php p($vehicle->name) ?></td>
                    <td><?php p($vehicle->VIN) ?></td>
                    <td><?php echo Vehicle::$colors[$vehicle->color] ?></td>
                    <td><?php p($vehicle->engine) ?></td>
                    <td><?php p($vehicle->SPZ) ?></td>
                    <td><?php p(dateTxt($vehicle->STK)) ?></td>
                    <td><?php p(dateTxt($vehicle->insurance)) ?></td>
                    <td><?php p($vehicle->tachometer) ?></td>
                    <td><?php p($vehicle->note) ?></td>
                    <td><?php p($vehicle->avg_kilometers) ?></td>
                    <td><?php p($vehicle->tires_size) ?></td>
                    <td><?php p($vehicle->tires_type) ?></td>
                    <td><?php p($vehicle->tires_kind) ?></td>
                    <td><?php p($vehicle->tires_brand) ?></td>
                    <td><?php p($vehicle->tires_mm) ?></td>
                    <td><?php p(boolTxt($vehicle->archived)) ?></td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
</div>