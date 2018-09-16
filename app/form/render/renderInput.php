<?php
  function renderInput($inputData) {
    $valueAtr = !empty($inputData['value']) 
      ? "value = \"".$inputData['value']."\"" : "";
    $classAtr = $inputData["type"] == "checkbox"
      ? ""
      : "class=\"form-control col-lg-5";
    return "
      <input 
        type=".$inputData['type']." name=".$inputData['name']." ".
        $classAtr." ".$inputData['class']."\" 
        ".$valueAtr.">
    ";
  }
?>