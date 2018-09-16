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
  function authorizeUser($inputsData) {
    $login = $inputsData['login']['value'];
    if (!empty($login)) {
      define("USERS_TABLE", "users");
      define("SELECT_ONE", true);
      
      $selectConditions = ["login" => $login];
  
      $user = select(USERS_TABLE, $selectConditions, SELECT_ONE);
  
      $authDataStatus = checkAuthData($user);
      
      if ($authDataStatus == "correct") {
  
        $updateData = ["last_entry" => date("Y-m-d H:i:s")];
      
        if ($inputsData['remember']['value'] == "on") {
          $cookiesUpdateData = rememberUser($login);
          $updateData = array_merge($updateData, $cookiesUpdateData);
        } else {
          // Если другой аккаунт, заходивший до этого был отмечен "запомнить" - 
          // т.е. был в куках, то обнуляем его.
          setcookie("key", "", time(), "/");  
          setcookie("login", "", time(), "/");
        }
  
        if (update(USERS_TABLE, $updateData, $selectConditions)) {
          $updatedUser = select(USERS_TABLE, $selectConditions, SELECT_ONE);
          session_start();
          $_SESSION['user'] = $updatedUser;
        }
      }      
    } else {
      return "Не указан логин";
    }
    return $authDataStatus;
  }
?>