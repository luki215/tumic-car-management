<!-- 
    Declare these variables:
    $label = label
    $name = form control name
-->

<div class="form-group">
    <label for="form-control-<?php echo $name ?>"><?php echo $label ?></label>
    <textarea name="<?php echo $name ?>" class="form-control" id="form-control-<?php echo '$name' ?>"></textarea>
</div>