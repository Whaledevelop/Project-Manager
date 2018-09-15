<?php
  session_start();
  define("FORM_FOLDER_PATH", $_SESSION['root']."/app/form");
  require_once FORM_FOLDER_PATH."/inputsPreparation/prepareFormData.php";
  require_once FORM_FOLDER_PATH."/validation/checkAreAllInputsCorrect.php";
  require_once FORM_FOLDER_PATH."/render/renderFormWithValidation.php";
  
  require_once $_SESSION['root']."/app/renderPage.php";

  require_once $_SESSION['root']."/profile/edit/pickEditInputs.php";
  require_once $_SESSION['root']."/profile/edit/editUser.php";
  
  require_once $_SESSION['root']."/sql/select.php";
   
  if (isset($_GET['login']) && isset($_GET['inputs'])) { 
 
    $neededInputNames = pickEditInputs($_GET['inputs']);

    if (!empty($neededInputNames)) {
      $login = $_GET['login'];
      $userInitialData = $login == $_SESSION['user']['login']
        ? $_SESSION['user']
        : select("users", ['login' => $login]);
      $enteredValues = $_POST;
      
      $inputsData = prepareFormData($neededInputNames, $enteredValues, $userInitialData);
      
      if (checkAreAllInputsCorrect($inputsData)) {
        
        $editFormMessage = editUser($inputsData, $login);
      }
  
      $editUserPageContent = renderFormWithValidation(
        $inputsData, "Изменить", $editFormMessage);
  
      define("PAGE_TITLE_AND_HEADER", "Изменение профиля ".$login);
      echo renderPage($editUserPageContent, PAGE_TITLE_AND_HEADER, PAGE_TITLE_AND_HEADER);
    } else {
      echo renderPage("Среди необходимых инпутов указаны неизменяемые поля", "Ошибка");
    }
  } else {
    echo renderPage("Не указан логин профиля или необходимые поля для формы", "Ошибка");
  }

?>


  