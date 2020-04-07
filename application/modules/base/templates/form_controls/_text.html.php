<!-- 
    Declare these variables:
    $label = label
    $name = form control name
    $value = previously set value
    $error = Error if not valid
-->

<div class="form-group">
    <label for="form-control-<?php echo $name ?>"><?php echo $label ?></label>
    <input type="text" name="<?php echo $name ?>" class="form-control <?php echo isset($error) ? 'is-invalid' : '' ?>" id="form-control-<?php echo $name ?>" value="<?php echo isset($value) ? $value : "" ?>">
    <div class="invalid-feedback">
        <?php echo $error ?>
    </div>
</div>