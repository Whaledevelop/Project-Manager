<?php
  session_start();
  require_once $_SESSION['root']."/app/renderPage.php";

  require_once $_SESSION['root']."/cabinet/renderSettingsPanel.php";
  require_once $_SESSION['root']."/cabinet/messages/renderMessagesPanel.php";
 
  $user = $_SESSION['user'];
  
  if (!empty($user)) {
    $personalCabinetContent = "
      <div class = \"container row\">".
        renderSettingsPanel($user['login']).
        renderMessagesPanel($user['id'])."
      </div>
    ";

    define("PAGE_TITLE", "Личный кабинет ".$user['login']);
    echo renderPage($personalCabinetContent, PAGE_TITLE);
  } else {
    define("PAGE_MESSAGE", "Ошибка авторизации");
    echo renderPage(PAGE_MESSAGE, PAGE_MESSAGE);
  }
?>