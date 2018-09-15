<?php
  function renderInput($inputData) {
    $valueAtr = !empty($inputData['value']) 
      ? "value = \"".$inputData['value']."\"" : "";
    return "
      <input 
        type=".$inputData['type']." name=".$inputData['name']."
        class=\"form-control col-lg-5 ".$inputData['class']."\" 
        ".$valueAtr.">
    ";
  }
?>