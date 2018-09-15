<?php
  require_once $_SESSION['root']."/sql/select.php";
  
  function renderMessagesPanel($userId) {
    define("MESSAGES_TABLE", "messages");
    define("SELECT_ALL", false);
    $messages = select(MESSAGES_TABLE, ["recipient_id" => $userId], SELECT_ALL);

    $numberOfUnreadMessages = array_count_values(
      array_column($messages, "isRead"))[0];

    switch ($numberOfUnreadMessages) {
      case 0: {
        $unreadStatusText = "нет непрочитанных";
        break;
      }
      case 1: {
        $unreadStatusText = "1 непрочитанное";
        $unreadStatusClass = "red";
        break;
      }
      default: {
        $unreadStatusText = $numberOfUnreadMessages." непрочитанных";
        $unreadStatusClass = "red";
        break;
      }
    }
    $unreadStatus = "<span class=\"".$unreadStatusClass."\">".$unreadStatusText."</span>";

    return "
      <div class = \"col-lg-6 pagePanel messagesPanel\">
        <h5 class=\"pageSubheader\">Панель сообщений</h5>
        <ul>
          <li>
            <a href=\"/cabinet/messages/incomingMessages.php\">
              Входящие (".$unreadStatus.")
            </a>
          </li>
          <li><a href=\"/cabinet/messages/outcomingMessages.php\">
            Исходящие сообщения
          </a></li>
        </ul>
        <div class = \"row justify-content-center\">
          <a class=\"whiteLink\" 
            href=\"/cabinet/messages/writeMessage.php\"
          >
            <button class=\"btn btn-info \">
              Написать сообщение
            </button>
          </a>
        </div>
      </div>
    ";
  }
?>
