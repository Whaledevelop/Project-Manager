<?php
  require_once $_SESSION['root']."/sql/select.php";

  function getMessageContent($messageData, $isIncoming) {
    $selectConditions = $isIncoming
      ? ["id" => $messageData["sender_id"]] 
      : ["id" => $messageData["recipient_id"]];
    define("USERS_TABLE", "users");
    define("SELECT_ONE", true);
    $interlocutor = select(USERS_TABLE, $selectConditions, SELECT_ONE);

    $sendTime = date("j M - G:i", strtotime($messageData['send_time']));

    $answerButtonText = $isIncoming ? "Ответить" : "Написать еще сообщение";

    return "
      <p><b>".$interlocutor['name']."</b> (".$sendTime.")</p>
      <hr/>
      <h6>".$messageData['theme']."</h6>
      <p>".$messageData['text']."</p>
      <p>
        <a href=\"".
          $_SESSION['rootHref']."/cabinet/messages/writeMessage.php?recipient_id="
          .$interlocutor['id']."
        \">       
          <button class=\"btn btn-default\">".
            $answerButtonText."
          </button>
        </a>
      </p>
    ";
  }
?>