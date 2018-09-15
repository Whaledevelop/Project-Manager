<?php
  require_once $_SESSION['root']."/auth/checkAuthData.php";
  require_once $_SESSION['root']."/auth/rememberUser.php";

  require_once $_SESSION['root']."/sql/update.php";
  require_once $_SESSION['root']."/sql/select.php";
  /*
    Функция проверяет данные, введенные в форму авторизации.
    В случае, если все данные верны, она добавляет данные пользователя 
    в сессию, а также, если указан флажок "Запомнить" запоминает
    его при помощи куки
    После успешного выполнения, она запоминает время входа в аккаунт
    и ключ логина в куки, добавляя эти данные в БД
  */
  function authorizeUser() {
    define("USERS_TABLE", "users");
    define("SELECT_ONE", true);
    $user = select(USERS_TABLE, ["login" => $_REQUEST['login']], SELECT_ONE);
    $authDataStatus = checkAuthData($user);
    
    if ($authDataStatus == "correct") {

      $nowInSqlDateFormat = date("Y-m-d H:i:s");
      $updateData = ["last_entry" => $nowInSqlDateFormat];
    
      if ($_REQUEST['remember'] == "on") {
        $cookiesUpdateData = rememberUser($nowInSqlDateFormat, $user['login']);
        $updateData = array_merge($updateData, $cookiesUpdateData);
      } else {
        // Если другой аккаунт, заходивший до этого был отмечен "запомнить" - 
        // т.е. был в куках, то обнуляем его.
        setcookie("key", "", time(), "/");  
        setcookie("login", "", time(), "/");
      }
      
      if (update(USERS_TABLE, $updateData, ["login" => $user['login']])) {
        $updatedUser = select(USERS_TABLE, ["login" => $user['login']], SELECT_ONE);
        session_start();
        $_SESSION['user'] = $updatedUser;
      }      
    }
    return $authDataStatus;
  }
?>