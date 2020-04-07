<div class="form-group">
    <div class="custom-control custom-switch">
        <input type="checkbox" class="custom-control-input  <?php echo isset($error) ? 'is-invalid' : '' ?>" id="form-control-<?php echo $name ?>" name="<?php echo $name ?>" <?php echo $value ? "checked" : "" ?>>
        <label class="custom-control-label" for="form-control-<?php echo $name ?>"><?php echo $label ?></label>
        <div class="invalid-feedback">
            <?php echo $error ?>
        </div>
    </div>
</div>