<?php
  session_start();
  require_once $_SESSION['root']."/app/form/prepareFormData.php";
  require_once $_SESSION['root']."/app/form/checkAreAllInputsCorrect.php";
  require_once $_SESSION['root']."/app/form/renderFormWithValidation.php";
  require_once $_SESSION['root']."/app/renderPage.php";

  require_once $_SESSION['root']."/reg/prepareRegData.php";

  require_once $_SESSION['root']."/sql/add.php";

  require_once $_SESSION['root']."/verification/sendVerificationMail.php";
  

  $neededInputsNames = ["login", "password", "passwordConfirm", "name", "email"];
  $inputsData = prepareFormData($neededInputsNames, $_POST);
  if (checkAreAllInputsCorrect($inputsData)) {
    $userRegData = prepareRegData($_POST); 
    define("USERS_TABLE", "users");
    
    if (add(USERS_TABLE, $userRegData)) {
      if (sendVerificationMail($userRegData)) {
        header("Location: /35-42_auth_registr/37-42/reg/regSuccess.php?login=".
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

  $regPageContent = renderFormWithValidation($inputsData, "Зарегистрироваться", $regFormMessage);
  define("PAGE_TITLE_AND_HEADER", "Форма регистрации");
  echo renderPage($regPageContent, PAGE_TITLE_AND_HEADER, PAGE_TITLE_AND_HEADER)
?>
  




