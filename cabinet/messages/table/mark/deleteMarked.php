<?php
  require_once $_SESSION['root']."/sql/delete.php";

  function deleteMarked($markedIds) {
    $idsOfMarkedToDelete = [];
    foreach ($markedIds as $markedMessageId => $value) {
      $idsOfMarkedToDelete['id'][] = $markedMessageId;
    }

    define("MESSAGES_TABLE", "messages");
    define("CONDITIONS_DEVIDER", "OR");

    return delete(MESSAGES_TABLE, $idsOfMarkedToDelete, CONDITIONS_DEVIDER);
  }
?>