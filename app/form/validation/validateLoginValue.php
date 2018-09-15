<?php
  require_once $_SESSION['root']."/sql/select.php";
  
  function validateLoginValue($login) {
    if (!empty($login)) {
      $isLoginEng = preg_match("#^ [a-z0-9]+ $#ixs", $login);
      if ($isLoginEng) {

        $conditions = ['login' => $login];
        define("USERS_TABLE", "users");
        define("SELECT_ONE", true);
        $userWithEnteredLogin = select(USERS_TABLE, $conditions, SELECT_ONE);
      
        $isLoginOccupied = !empty($userWithEnteredLogin);
        return $isLoginOccupied ? "Логин занят" : "correct";
      } else {
        return "Логин должен содержать
          только латиницу и цифры";
      } 
    } else {
      return "Введите логин";
    } 
  }
?>