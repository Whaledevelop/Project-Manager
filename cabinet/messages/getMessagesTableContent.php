<?php
  require_once $_SESSION['root']."/app/table/renderTable.php";

  require_once $_SESSION['root']."/cabinet/messages/prepareMessagesStrings.php";
  require_once $_SESSION['root']."/cabinet/messages/prepareMarkButtons.php";

  require_once $_SESSION['root']."/sql/select.php";

  function getMessagesTableContent($tableHeaders, $areIncoming) {
    $selectConditions = $areIncoming
      ? ['recipient_id' => $_SESSION['user']['id']]
      : ['sender_id' => $_SESSION['user']['id']];

    define("MESSAGES_TABLE", "messages");
    define("SELECT_ALL", false);
    $messagesData = select(MESSAGES_TABLE, $selectConditions, SELECT_ALL);
  
    usort($messagesData, function($a, $b) {
      return strtotime($b['send_time']) <=> strtotime($a['send_time']);
    });

    $messagesStrings = prepareMessagesStrings($messagesData, $areIncoming);
    
    $markButtons = prepareMarkButtons($messagesData, $areIncoming);

    array_unshift($tableHeaders, "");
    
    return renderTable($tableHeaders, $messagesStrings, $markButtons);
  }
?>