<?php
  require_once $_SESSION['root']."/app/modules/generateCode.php";

  function rememberUser($login) {
    $key = generateCode(6);
    setcookie("key", $key, time() + 2592000, "/"); // 2592000 - это месяц
    setcookie("login", $login, time() + 2592000, "/");
    $cookieUpdateData = [
      "cookie" => $key,
      "last_entry_with_cookie" => date("Y-m-d H:i:s")
    ];
    return $cookieUpdateData;
  }

?>