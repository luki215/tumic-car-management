<?php $conflict = isset($conflict_value) && ($conflict_value != ($value ? "1" : "0")) ?>
<div class="form-group">
    <div class="custom-control custom-switch">
        <input type="checkbox" class="custom-control-input  <?php echo isset($error) || $conflict ? 'is-invalid' : '' ?>" id="form-control-<?php echo $name ?>" name="<?php echo $name ?>" <?php echo $value ? "checked" : "" ?>>
        <label class="custom-control-label" for="form-control-<?php echo $name ?>"><?php echo $label ?></label>
        <div class="invalid-feedback">
            <?php if ($conflict) { ?>
                <?php p('Nová hodnota: ' . (($conflict_value) ? "pravda" : "nepravda")) ?>
                <br>
            <?php } ?>
            <?php echo $error ?>
        </div>
    </div>
</div>