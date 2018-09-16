<?php
  session_start();
  define("FORM_FOLDER_PATH", $_SESSION['root']."/app/form");
  require_once FORM_FOLDER_PATH."/inputsPreparation/prepareFormData.php";
  require_once FORM_FOLDER_PATH."/validation/checkAreAllInputsCorrect.php";
  require_once FORM_FOLDER_PATH."/render/renderForm.php";
  
  require_once $_SESSION['root']."/app/renderPage.php";

  require_once __DIR__."/prepareRegData.php";

  require_once $_SESSION['root']."/sql/add.php";

  require_once $_SESSION['root']."/verification/sendVerificationMail.php";
  

  $neededInputsNames = ["login", "password", "passwordConfirm", "name", "email"];
  $inputsData = prepareFormData($neededInputsNames, $_POST, true);
  if (checkAreAllInputsCorrect($inputsData)) {
    $userRegData = prepareRegData($_POST); 
    define("USERS_TABLE", "users");
    
    if (add(USERS_TABLE, $userRegData)) {
      if (sendVerificationMail($userRegData)) {
        header("Location: /reg/regSuccess.php?login=".
          $_POST['login']."&email=".$_POST['email']);
      } else {
        $regFormMessage = "Ошибка отправки письма верификации";
      }
    } else {
      $regFormMessage = "Ошибка добавления данных пользователя в базы данных";
    }
  } else {
    if (!empty($_POST)) {
      $emptyInputs = [];
      foreach($inputsData as $inputData) {
        if (empty($inputData['value'])) {
          $emptyInputs[] = $inputData['label'];
        }
      }
      if (!empty($emptyInputs)) {
        $regFormMessage = "Заполните следующие поля: ".implode(", ", $emptyInputs);
      } 
    }
  }

  $regPageContent = renderForm($inputsData, "Зарегистрироваться", $regFormMessage);
  define("PAGE_TITLE_AND_HEADER", "Форма регистрации");
  echo renderPage($regPageContent, PAGE_TITLE_AND_HEADER, PAGE_TITLE_AND_HEADER)
?>
  




