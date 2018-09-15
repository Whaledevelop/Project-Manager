<?php
  define("VALIDATION_PATH", FORM_FOLDER_PATH."/validation");
  require_once VALIDATION_PATH."/validateEmailValue.php";
  require_once VALIDATION_PATH."/validateLoginValue.php";
  require_once VALIDATION_PATH."/validateNameValue.php";
  require_once VALIDATION_PATH."/validatePasswordValue.php";
  require_once VALIDATION_PATH."/validatePasswordConfirmValue.php";
  require_once VALIDATION_PATH."/validatePasswordProtectValue.php";
  require_once VALIDATION_PATH."/validateThemeValue.php";
  require_once VALIDATION_PATH."/validateTextValue.php";

  function prepareInputData($inputData, $enteredValues, $initialData) {
    $inputName = $inputData['name'];
    $enteredValue = $enteredValues[$inputName];
    $initialValue = !empty($initialData) && $inputName != "password"
      ? $initialData[$inputName] 
      : "";

    if (!empty($enteredValues)) {
      if (!empty($enteredValue) && $enteredValue != $initialValue) {
        $inputData['value'] = strip_tags(trim($enteredValue));
        $validationFunctionParams = [$inputData['value']];

        switch ($inputName) {
          case "passwordConfirm" : {
            $validationFunctionParams[] = $enteredValues['password'];
            break;
          }
          case "passwordProtect" : 
          case "password" : {
            $validationFunctionParams[] = $initialData['password'];
            $validationFunctionParams[] = $initialData['salt'];
            break;
          }     
        }

        $validationFunctionName = "validate".ucfirst($inputName)."Value";
        $inputData['status'] = call_user_func_array(
          $validationFunctionName, $validationFunctionParams
        );

        $inputData['class'] = $inputData['status'] == "correct" ? "correct" : "noncorrect";
      } else {
        $inputData['value'] = $initialValue;
        $inputData['status'] = "Значение не изменено";
      }
      
    } else {
      $inputData['value'] = $initialValue;
    }
    return $inputData;
  }
?>