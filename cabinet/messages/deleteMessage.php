<?php
  session_start();
  require_once $_SESSION['root']."/app/renderPage.php";

  require_once $_SESSION['root']."/sql/delete.php";

  if ($_GET['id']) {
    define("MESSAGES_TABLE", "messages");
    if (delete(MESSAGES_TABLE, ['id' => $_GET['id']])) {
      $deleteMessagePageContent = "
        <p>Сообщение удалено</p>
        <a href=\"/cabinet/messages/\">Вернуться к сообщениям</a>
      ";
    } else {
      $deleteMessagePageContent = "Ошибка при удалении сообщения";
    }
  } else {
    $deleteMessagePageContent = "Не указан id сообщения";
  }
  echo renderPage($deleteMessagePageContent, "Удаление сообщения");
?>