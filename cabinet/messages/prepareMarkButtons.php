<?php
  function prepareMarkButtons($messagesData, $areIncoming) {
    $markButtons = [
      "<input 
        name=\"delete\" class = \"btn btn-default\" 
        type=\"submit\" value=\"Удалить отмеченные\""      
    ];

    if ($areIncoming) {
      $unreadMessagesCount = array_count_values(
        array_column($messagesData, "isRead")
      )[0];
  
      if (!empty($unreadMessagesCount)) {
        $markButtons[] = "
          <input 
            name=\"markAsRead\" class = \"btn btn-info\" 
            type=\"submit\" value=\"Отметить как прочитанные\"
        ";
      }
    }
    return $markButtons;
  }
?>