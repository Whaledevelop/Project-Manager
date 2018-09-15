<?php
  session_start();
  require_once $_SESSION['root']."/app/form/prepareFormData.php";
  require_once $_SESSION['root']."/app/form/checkAreAllInputsCorrect.php";
  require_once $_SESSION['root']."/app/form/renderFormWithValidation.php";
  require_once $_SESSION['root']."/app/renderPage.php";

  require_once $_SESSION['root']."/sql/delete.php";
  
  $protectInput = ["passwordProtect"];
  $enteredValues = $_POST;
  $userInitialData = $_SESSION['user'];
  if (!empty($userInitialData)) {
    $inputsData = prepareFormData($protectInput, $enteredValues, $userInitialData);
    
    if (checkAreAllInputsCorrect($inputsData)) {    
      define("USERS_TABLE", "users");
      if (delete(USERS_TABLE, ["login" => $_SESSION['user']['login']])) {
        $deletePageContent = "Вы успешно удалили аккаунт";
      }
    } else {
      $deletePageContent = "
        <p>".$_SESSION['user']['login'].", вы действительно хотите удалить свой аккаунт?</p>
        <p>Аккаунт нельзя будет восстановить</p>
        ".renderFormWithValidation($inputsData, "Удалить аккаунт")
      ;
    }
  } else {
    $deletePageContent = "Для того чтобы удалить аккаунт, надо авторизоваться";
  }
  define("PAGE_TITLE", "Удаление аккаунта");
  echo renderPage($deletePageContent, PAGE_TITLE);
  
?>