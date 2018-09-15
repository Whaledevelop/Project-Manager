<?php
  function renderSelect($inputData) {
    $optionsStr = "<option></option>";
    foreach ($inputData['options'] as $option) {
      $optionsStr .= "
        <option 
          value=\"".$option['value']."\"".
          ($option['value'] == $inputData['value'] ? " selected" : "")."
        >".
          $option['label']."
        </option>
      ";
    }
    return "
      <select 
        name=\"".$inputData['name']."\" 
        class=\"form-control col-lg-5 ".$inputData['class']."\"
      >".
        $optionsStr."
      </select>
    ";
  }
?>