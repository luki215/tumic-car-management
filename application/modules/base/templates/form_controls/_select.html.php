 <!-- 
    Declare these variables:
    $label = label
    $name = form control name
    $options = keyval array of options eg. ["1" => "First option", "2"=>"Second option"]
-->


 <div class="form-group">
     <select class="custom-select <?php echo isset($error) ? 'is-invalid' : '' ?>" name="<?php echo $name; ?>">
         <option value=""><?php echo $label; ?></option>
         <?php foreach ($options as $selValue => $label) { ?>
             <option value="<?php echo $selValue; ?>" <?php echo $selValue == $value ? "selected" : "" ?>>
                 <?php echo $label; ?>
             </option>
         <?php } ?>
     </select>
     <div class="invalid-feedback">
         <?php echo $error ?>
     </div>
 </div>