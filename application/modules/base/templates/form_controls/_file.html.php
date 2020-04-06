 <!-- 
    Declare these variables:
    $label = label
    $name = form control name
-->

 <div class="form-group">
     <div class="custom-file">
         <input type="file" class="custom-file-input" id="<?php echo $name; ?>">
         <label class="custom-file-label" for="form-control-<?php echo $name; ?>"><?php echo $label ?></label>
         <div class="invalid-feedback">Example invalid custom file feedback</div>
     </div>
 </div>