<?php
  require_once $_SESSION['root']."/sql/select.php";

  function renderAuthMainPage() {
    define("USERS_TABLE", "users");
    $users = select(USERS_TABLE);
    $loginsStringList = "";
    foreach ($users as $user) {
      if ($user['isVerified']) {
        $loginsStringList .= "
        <li>
          <a href = \"/profile/index.php?login=".$user['login']."\">".
            ($user['login'] == $_SESSION['user']['login']
              ? "<u>".$user['login']."</u>"
              : $user['login']
            )."
          </a>
        </li>
      ";
      }
    }
    return "
      <p>Профили пользователей зарегистрированных на сайте</p>
      <ul>".
        $loginsStringList."
      </ul>
    ";
  }
?>