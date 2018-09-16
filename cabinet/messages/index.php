<?php
  session_start();
  require_once $_SESSION['root']."/app/renderPage.php";
  
  require_once __DIR__."/renderMessagesPanel.php";
  
  $messagesPageContent = renderMessagesPanel($_SESSION['user']['id']);
  define("PAGE_TITLE", "Панель сообщений");
  echo renderPage($messagesPageContent, PAGE_TITLE);
?>