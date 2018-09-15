<?php
  function pickEditInputs($requestedInputsNames) {
    $inputsNames = [];
    $editableInputs = ["login", "name", "email", "password"];
    foreach ($requestedInputsNames as $inputName) {
      if (in_array($inputName, $editableInputs)) {
        $inputsNames[] = $inputName;
        if ($inputName == "password") {
          $inputsNames[] = "passwordConfirm";
        }
      } else {
        return null;
      }
    }
    return $inputsNames;
  }
?>