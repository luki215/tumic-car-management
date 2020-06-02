 <!-- 
    Declare these variables:
    $label = label
    $name = form control name
    $options = keyval array of options eg. ["1" => "First option", "2"=>"Second option"]
-->

 <?php $conflict = isset($conflict_value) && $conflict_value != $value ?>

 <div class="form-group">
     <select class="custom-select <?php echo isset($error) || $conflict ? 'is-invalid' : '' ?>" name="<?php echo $name; ?>">
         <option value=""><?php echo $label; ?></option>
         <?php foreach ($options as $selValue => $label) { ?>
             <option value="<?php echo $selValue; ?>" <?php echo $selValue == $value ? "selected" : "" ?>>
                 <?php echo $label; ?>
             </option>
         <?php } ?>
     </select>
     <div class="invalid-feedback">
         <?php if ($conflict) { ?>
             <?php p("Nová hodnota: $options[$conflict_value]") ?>
             <br>
         <?php } ?>
         <?php echo $error ?>
     </div>
 </div>