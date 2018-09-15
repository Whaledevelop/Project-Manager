<?php
  session_start();
  $_SESSION['root'] = str_replace("\\", "/", __DIR__);

  require_once $_SESSION['root']."/app/renderPage.php";

  require_once $_SESSION['root']."/auth/checkIsUserRemembered.php";
  
  require_once $_SESSION['root']."/main/renderAuthMainPage.php";
  require_once $_SESSION['root']."/main/renderNotAuthMainPage.php";

  $mainPageContent = checkIsUserRemembered()
    ? renderAuthMainPage()
    : renderNotAuthMainPage();
  
  define("PAGE_TITLE", "Главная страница");
  echo renderPage($mainPageContent, PAGE_TITLE, PAGE_TITLE);
?>


  