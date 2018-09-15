<?php
  require_once $_SESSION['root']."/app/modules/generateCode.php";

  function rememberUser($nowInSqlDateFormat, $login) {
    $key = generateCode(6);
    setcookie("key", $key, time() + 2592000, "/"); // 2592000 - это месяц
    setcookie("login", $login, time() + 2592000, "/");
    $cookieUpdateData = [
      "cookie" => $key,
      "last_entry_with_cookie" => $nowInSqlDateFormat
    ];
    return $cookieUpdateData;
  }

?>