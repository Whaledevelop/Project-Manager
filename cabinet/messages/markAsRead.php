<?php
  require_once $_SESSION['root']."/sql/update.php";

  function markAsRead($markedIds) {
    $idsOfMarkedAsRead = [];
    foreach ($markedIds as $markedMessageId => $value) {
      $idsOfMarkedAsRead["id"][] = $markedMessageId;
    }

    $updateData = ['isRead' => 1];
    define("MESSAGES_TABLE", "messages");
    define("CONDITIONS_DEVIDER", "OR");

    return update(MESSAGES_TABLE, $updateData, $idsOfMarkedAsRead, CONDITIONS_DEVIDER);
  }
?>