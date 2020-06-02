 <!-- 
    Declare these variables:
    $label = label
    $name = form control name
-->
 <?php $conflict = isset($conflict_value) && $conflict_value != $value ?>

 <div class="form-group">
     <div class="custom-file">
         <input type="file" class="custom-file-input <?php echo isset($error) || $conflict ? 'is-invalid' : '' ?>" id="<?php echo $name; ?>" value="<?php p(isset($value) ? $value : "") ?>">
         <label class=" custom-file-label" for="form-control-<?php echo $name; ?>"><?php echo $label ?></label>
         <div class="invalid-feedback">
             <?php if ($conflict) { ?>
                 <?php p("Nová hodnota: $conflict_value") ?>
                 <br>
             <?php } ?>
             <?php echo $error ?>
         </div>
     </div>
 </div>