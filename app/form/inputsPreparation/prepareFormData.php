<?php
  define("FORM_FOLDER_PATH", $_SESSION['root']."/app/form");
  require_once FORM_FOLDER_PATH."/inputsPreparation/prepareInputData.php";
  require_once FORM_FOLDER_PATH."/inputsPreparation/prepareSelectData.php";

  function prepareFormData($neededInputsNames, $enteredValues, $initialData = []) {
    /*
      Если начальные данные пользователя не пусты, то форма используется 
      для редактирования. При редактировании пароля или логина требуется 
      ввести действующий пароль
    */
    if (!empty($initialData) && 
      (in_array("password", $neededInputsNames) 
        || in_array("login", $neededInputsNames))
    ) {
      $neededInputsNames[] = "passwordProtect";
    }

    define("INITIAL_DATA_PATH", FORM_FOLDER_PATH."/inputsInitialData.json");
    $inputsInitialDataJson = file_get_contents(INITIAL_DATA_PATH );
    $inputsInitialData = json_decode($inputsInitialDataJson, true);
    
    $inputsData = [];
    foreach ($inputsInitialData as $inputInitialData) {
      if (in_array($inputInitialData['name'], $neededInputsNames)) {

        $inputData = $inputInitialData['element'] == "select"
          ? prepareSelectData($inputInitialData, $enteredValues, $initialData)
          : prepareInputData($inputInitialData, $enteredValues, $initialData);

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