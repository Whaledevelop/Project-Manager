<?php
  require_once $_SESSION['root']."/sql/select.php";
  
  function checkIsUserRemembered() {
    if (!empty($_COOKIE['login']) && !empty($_COOKIE['key'])) {
      define("USERS_TABLE", "users");
      $selectConditions = ['login' => $_COOKIE['login'], 'cookie' => $_COOKIE['key']];
      define("SELECT_ONE", true);
      $user = select(USERS_TABLE, $selectConditions, SELECT_ONE);
  
      if (!empty($user)) {
        $_SESSION['user'] = $user;
        return true;
      }        
    } else if (!empty($_SESSION['user'])) {
      return true;
    }
    return false;
  }
?>