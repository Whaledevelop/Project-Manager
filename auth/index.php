<?php
  session_start();
  require_once $_SESSION['root']."/app/renderPage.php";

  require_once $_SESSION['root']."/auth/authorizeUser.php";
  require_once $_SESSION['root']."/auth/renderAuthForm.php";
  
  if (!empty($_REQUEST['login']) && !empty($_REQUEST['password'])) {
    
    $authDataStatus = authorizeUser();
    if ($authDataStatus == "correct") {
      header("Location: /");
    }
  } 
  $authPageContent = renderAuthForm($authDataStatus)."<hr/>
    <p>Нет аккаунта? 
      <a href=\"/reg/index.php\">
        Зарегистрироваться
      </a>
    </p>
  ";

  define("PAGE_TITLE_AND_HEADER", "Форма авторизации");
  echo renderPage($authPageContent, PAGE_TITLE_AND_HEADER, PAGE_TITLE_AND_HEADER);
?>



