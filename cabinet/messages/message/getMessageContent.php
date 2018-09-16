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

    $answerParams = "recipientId=".$interlocutor['id'];
    $answerHref = "/cabinet/messages/write/index.php?".$answerParams;
    $answerButtonText = $isIncoming ? "Ответить" : "Написать еще сообщение";

    return "
      <p><b>".$interlocutor['name']."</b> (".$sendTime.")</p>
      <hr/>
      <h6>".$messageData['theme']."</h6>
      <p>".$messageData['text']."</p>
      <p>
        <a href=\"/cabinet/messages/deleteMessage.php?id="
          .$messageData['id']."
        \">       
          <button class=\"btn btn-default\">
            Удалить сообщение
          </button>
        </a>
      </p>
      <p>
        <a href=\"".$answerHref."\">       
          <button class=\"btn btn-info\">".
            $answerButtonText."
          </button>
        </a>
      </p>
    ";
  }
?>