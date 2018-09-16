<?php
  require_once $_SESSION['root']."/app/modules/stringPreview.php";

  require_once $_SESSION['root']."/sql/select.php";

  function prepareMessagesStrings($messagesData, $areIncoming) {
    foreach ($messagesData as $messageData) {
    
      $selectConditions = $areIncoming 
        ? ['id' => $messageData['sender_id']]
        : ['id' => $messageData['recipient_id']];
      define("USERS_TABLE", "users");
      define("SELECT_ONE", true);
      $interlocutor = select(USERS_TABLE, $selectConditions, SELECT_ONE);
  
      $themePreview = stringPreview($messageData['theme'], 50);
      $textPreview = stringPreview($messageData['text'], 50);
      $sendTime = date("j M - G:i", strtotime($messageData['send_time']));
  
      $tdClass = $areIncoming 
        ? $messageData['isRead'] ? "read" : "unread"
        : "";
  
      $markCheckbox = "
        <input 
          class = \"\" type=\"checkbox\" 
          name=\"markedMessagesIds[".$messageData['id']."]\"/>
      ";

      $onclickParams = "id=".$messageData['id'];
      $onclickHref = "/cabinet/messages/message/index.php?".$onclickParams;
      $onclickAttr = "onclick = \"window.location.href='".$onclickHref."'\"";
        
      $messageString = "
        <tr class = \"messageString\">
          <td>".$markCheckbox."</td>
          <td class=\"".$tdClass."\" ".$onclickAttr.">".
            $interlocutor['name']."
          </td>
          <td class=\"".$tdClass."\" ".$onclickAttr.">".
            $themePreview."
          </td>
          <td ".$onclickAttr.">".
            $textPreview."
          </td>
          <td class=\"".$tdClass."\" ".$onclickAttr.">".
            $sendTime."
          </td>
        </tr>
      ";
      $messagesStrings[] = $messageString;
    }
    return $messagesStrings;
  }
?>  