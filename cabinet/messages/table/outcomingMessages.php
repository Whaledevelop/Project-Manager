<?php
  session_start();
  require_once $_SESSION['root']."/app/renderPage.php";

  require_once __DIR__."/getMessagesTableContent.php";  

  require_once __DIR__."/mark/deleteMarked.php";

  if (!empty($_REQUEST['markedMessagesIds'])) {
    $markedIds = $_REQUEST['markedMessagesIds'];
    if (isset($_REQUEST['delete'])) {
      deleteMarked($markedIds);
    } 
  }

  $tableHeaders = ["Имя получателя", "Тема", "Текст", "Время отправления"];
  define("OUTCOMING_MESSAGES", false);
  $outcomingMessagesContent = getMessagesTableContent($tableHeaders, OUTCOMING_MESSAGES);

  define("PAGE_TITLE_AND_HEADER", "Исходящие сообщения");
  echo renderPage($outcomingMessagesContent, PAGE_TITLE_AND_HEADER, PAGE_TITLE_AND_HEADER);
?>