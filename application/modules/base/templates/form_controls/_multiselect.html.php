 <!-- 
    Declare these variables:
    $label = label
    $name = form control name
    $options = keyval array of options eg. ["1" => "First option", "2"=>"Second option"]
-->


 <div class="form-group">
     <label for="multiselect-<?php p($name) ?>"><?php p($label) ?></label>
     <select id="multiselect-<?php p($name) ?>" class="custom-select <?php echo isset($error) ? 'is-invalid' : '' ?>" name="<?php echo $name; ?>[]" multiple>
         <?php foreach ($options as $selValue => $label) { ?>
             <option value="<?php echo $selValue; ?>" <?php echo $value && in_array($selValue, $value) ? "selected" : "" ?>>
                 <?php echo $label; ?>
             </option>
         <?php } ?>
     </select>
     <div class="invalid-feedback">
         <?php echo $error ?>
     </div>
 </div>