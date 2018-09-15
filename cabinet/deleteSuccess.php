<?php
  session_start();
  require_once $_SESSION['root']."/app/renderPage.php";

  $deleteSuccessContent = "
    <p>Вы успешно удалили аккаунт</p>
    <a href = \"/\">
      Вернуться на главную
    </a>
  ";
  define("PAGE_TITLE", "Профиль удален");
  echo renderPage($deleteSuccessContent, PAGE_TITLE);
?>