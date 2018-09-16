<?php
  session_start();
  require_once $_SESSION['root']."/app/renderPage.php";
  require_once $_SESSION['root']."/app/form/inputsPreparation/prepareFormData.php";
  require_once $_SESSION['root']."/app/form/render/renderForm.php";

  require_once __DIR__."/authorizeUser.php";  

  $authInputsNames = ["login", "password", "remember"];
  $initialValues = isset($_GET['id']) ? ['id' => $_GET['id']] : [];

  define("NOT_VALIDATIVE_FORM", false);
  $inputsData = prepareFormData($authInputsNames, $_POST, NOT_VALIDATIVE_FORM, $initialValues);

  if (!empty($_POST)) {
    $authDataStatus = authorizeUser($inputsData);
  } 
  
  if ($authDataStatus == "correct") {
    header("Location: /");
  } 
  $authForm = renderForm($inputsData, "Авторизоваться", $authDataStatus);
  
  $authPageContent = $authForm."<hr/>
    <p>Нет аккаунта? 
      <a href=\"/reg/index.php\">
        Зарегистрироваться
      </a>
    </p>
  ";

  define("PAGE_TITLE_AND_HEADER", "Форма авторизации");
  echo renderPage($authPageContent, PAGE_TITLE_AND_HEADER, PAGE_TITLE_AND_HEADER);
?>



