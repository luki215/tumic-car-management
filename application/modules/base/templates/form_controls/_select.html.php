 <!-- 
    Declare these variables:
    $label = label
    $name = form control name
    $options = keyval array of options eg. ["1" => "First option", "2"=>"Second option"]
-->


 <div class="form-group">
     <select class="custom-select" name="<?php echo $name; ?>">
         <option value=""><?php echo $label; ?></option>
         <?php foreach ($options as $value => $label) { ?>
             <option value="<?php echo $value; ?>"><?php echo $label; ?></option>
         <?php } ?>
     </select>
     <div class="invalid-feedback">Example invalid custom select feedback</div>
 </div>