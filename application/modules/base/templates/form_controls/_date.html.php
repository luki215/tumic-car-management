<?php $conflict = isset($conflict_value) && $conflict_value != $value ?>

<div class="form-group">
    <label for="form-control-<?php echo $name; ?>"><?php echo $label; ?></label>
    <div class="input-group date" data-provide="datepicker" data-date-language="cs">
        <input type="text" class="form-control <?php echo isset($error) || $conflict ? 'is-invalid' : '' ?>" id="form-control-<?php echo $name; ?>" name="<?php echo $name; ?>" <?php if ($value) { ?> value="<?php p(dateTxt($value)) ?>" <?php } ?>>
        <div class=" input-group-append">
            <span class="btn btn-outline-secondary"> <i class="fa fa-calendar"></i></span>
        </div>
        <div class="invalid-feedback">
            <?php echo $error ?>
            <?php if ($conflict) { ?>
                <br>
                <?php p('Nová hodnota:' . dateTxt($conflict_value)) ?>
            <?php } ?>
        </div>
    </div>
</div>