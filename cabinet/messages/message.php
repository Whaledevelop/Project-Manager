<?php
  session_start();
  require_once $_SESSION['root']."/app/renderPage.php";

  require_once $_SESSION['root']."/cabinet/messages/getMessageContent.php";

  require_once $_SESSION['root']."/sql/select.php";
  require_once $_SESSION['root']."/sql/update.php";

  if (!empty($_REQUEST['id'])) {
    define("MESSAGES_TABLE", "messages");
    define("SELECT_ONE", true);
    $selectConditions = ['id' => $_REQUEST['id']];
    $messageData = select(MESSAGES_TABLE, $selectConditions, SELECT_ONE);

    $isIncoming = $messageData['recipient_id'] == $_SESSION['user']['id'];

    $messagePageContent = getMessageContent($messageData, $isIncoming);
  } else {
    $messagePageContent = "Не указан id сообщения";
  }
  define("PAGE_TITLE", "Сообщение с id ".$_REQUEST['id']);
  echo renderPage($messagePageContent, PAGE_TITLE);

  if ($messageData['isRead'] == 0 && $isIncoming) {
    $updateData = ['isRead' => 1];
    update(MESSAGES_TABLE, $updateData, $selectConditions);
  }
?>