<!-- 
    Declare these variables:
    $label = label
    $name = form control name
-->

<div class="form-group">
    <label for="form-control-<?php echo $name ?>"><?php echo $label ?></label>
    <textarea name="<?php echo $name ?>" class="form-control <?php echo isset($error) ? 'is-invalid' : '' ?>" id="form-control-<?php echo $name ?>"><?php p(isset($value) ? $value : "") ?></textarea>
    <div class="invalid-feedback">
        <?php echo $error ?>
    </div>
</div>