 <!-- 
    Declare these variables:
    $label = label
    $name = form control name
-->

 <div class="form-group">
     <div class="custom-file">
         <input type="file" class="custom-file-input <?php echo isset($error) ? 'is-invalid' : '' ?>" id="<?php echo $name; ?>" value="<?php p(isset($value) ? $value : "") ?>">
         <label class=" custom-file-label" for="form-control-<?php echo $name; ?>"><?php echo $label ?></label>
         <div class="invalid-feedback">
             <?php echo $error ?>
         </div>
     </div>
 </div>