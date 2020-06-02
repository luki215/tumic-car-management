<!-- 
    Declare these variables:
    $label = label
    $name = form control name
    $value = previously set value
    $error = Error if not valid
-->
<?php $conflict = isset($conflict_value) && $conflict_value != $value ?>
<div class="form-group">
    <label for="form-control-<?php echo $name ?>"><?php echo $label ?></label>
    <input type="text" name="<?php echo $name ?>" class="form-control <?php echo isset($error) || $conflict ? 'is-invalid' : '' ?>" id="form-control-<?php echo $name ?>" value="<?php p(isset($value) ? $value : "") ?>">
    <div class="invalid-feedback">
        <?php if ($conflict) { ?>
            <?php p("Nová hodnota: $conflict_value") ?>
            <br>
        <?php } ?>
        <?php echo $error ?>
    </div>
</div>