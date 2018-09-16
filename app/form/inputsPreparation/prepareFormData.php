<?php
  define("VALIDATION_PATH", $_SESSION['root']."/app/form/validation");
  require_once VALIDATION_PATH."/validateEmailValue.php";
  require_once VALIDATION_PATH."/validateLoginValue.php";
  require_once VALIDATION_PATH."/validateNameValue.php";
  require_once VALIDATION_PATH."/validatePasswordValue.php";
  require_once VALIDATION_PATH."/validatePasswordConfirmValue.php";
  require_once VALIDATION_PATH."/validatePasswordProtectValue.php";
  require_once VALIDATION_PATH."/validateThemeValue.php";
  require_once VALIDATION_PATH."/validateTextValue.php";
  require_once VALIDATION_PATH."/validateRecipientIdValue.php";

  function prepareFormData(
    $neededInputsNames, $enteredValues, $isValidative = true, $initialValues = []
  ) {

    if (!empty($initialValues) && 
      (in_array("password", $neededInputsNames) || in_array("login", $neededInputsNames))
    ) {
      $neededInputsNames[] = "passwordProtect";
    }

    define("INITIAL_DATA_PATH", $_SESSION['root']."/app/form/inputsInitialData.json");
    $inputsInitialDataJson = file_get_contents(INITIAL_DATA_PATH);
    $inputsInitialData = json_decode($inputsInitialDataJson, true);
    
    $inputsData = [];
    foreach ($inputsInitialData as $inputInitialData) {
      $inputData = $inputInitialData;
      $inputName = $inputData['name'];

      if (in_array($inputName, $neededInputsNames)) {
        $initialValue = !empty($initialValues) && $inputName != "password"
          ? $initialValues[$inputName] 
          : "";
        if (!empty($enteredValues)) {
          $enteredValue = strip_tags(trim($enteredValues[$inputName]));
          if ($isValidative) {
            
            if (!empty($enteredValue)) {
              if ($enteredValue != $initialValue) {
                $inputData['value'] = $enteredValue;
                
                $validationFunctionName = "validate".ucfirst($inputName)."Value";
                $validationFunctionParams = [$inputData['value']];
  
                switch ($inputName) {
                  case "passwordConfirm" : {
                    $validationFunctionParams[] = $enteredValues['password'];
                    break;
                  }
                  case "passwordProtect" : 
                  case "password" : {
                    $validationFunctionParams[] = $initialValues['password'];
                    $validationFunctionParams[] = $initialValues['salt'];
                    break;
                  }     
                }
                try {
                  $inputData['status'] = call_user_func_array(
                    $validationFunctionName, $validationFunctionParams
                  );
    
                  $inputData['class'] = $inputData['status'] == "correct" ? "correct" : "noncorrect";
                } catch (Error $error) { }
              } else {
                $inputData['value'] = $initialValue;
                $inputData['status'] = "Значение не изменено";
              }              
            } else {
              $inputData['value'] = $initialValue;
              $inputData['status'] = "Введите значение";
              $inputData['class'] = "noncorrect";
            }
            
          } else {
            $inputData['value'] = $enteredValue;
          }
        } else {
          $inputData['value'] = $initialValue;
        }
        $inputsData[$inputData['name']] = $inputData; 
      } 
    } 

    if (in_array("password", $neededInputsNames) 
      && in_array("passwordProtect", $neededInputsNames)) {
        $inputsData['password']['label'] = "Новый пароль";
        $inputsData['passwordConfirm']['label'] = "Подтверждение нового пароля";
        $inputsData['passwordProtect']['label'] = "Старый пароль";
    } 
    return $inputsData;
  } 
?>