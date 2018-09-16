<?php
  session_start();
  require_once $_SESSION['root']."/app/renderPage.php";

  require_once __DIR__."/getMessagesTableContent.php";  

  require_once __DIR__."/mark/markAsRead.php"; 
  require_once __DIR__."/mark/deleteMarked.php"; 

  if (!empty($_REQUEST['markedMessagesIds'])) {
    $markedIds = $_REQUEST['markedMessagesIds'];
    if (isset($_REQUEST['delete'])) {
      deleteMarked($markedIds);
    } 
    if (isset($_REQUEST['markAsRead'])) {
      markAsRead($markedIds);
    }
  }

  $tableHeaders = ["Имя отправителя", "Тема", "Текст", "Время отправления"];
  define("INCOMING_MESSAGES", true);
  $incomingMessagesContent = getMessagesTableContent($tableHeaders, INCOMING_MESSAGES);

  define("PAGE_TITLE_AND_HEADER", "Входящие сообщения");
  echo renderPage($incomingMessagesContent, PAGE_TITLE_AND_HEADER, PAGE_TITLE_AND_HEADER);
?>

