<?php
  require_once $_SESSION['root']."/profile/edit/filterServiceInputs.php";
  require_once $_SESSION['root']."/profile/edit/editPasswordData.php";

  require_once $_SESSION['root']."/sql/update.php";
  require_once $_SESSION['root']."/sql/select.php";

  require_once $_SESSION['root']."/verification/sendVerificationMail.php";
  
  function editUser($inputsData, $initialLogin) {
    $valuesForUpdate = filterServiceInputs($inputsData);
    if (!empty($valuesForUpdate['password'])) {
      $valuesForUpdate = editPasswordData($valuesForUpdate);
    }
    define("USERS_TABLE", "users");
    $updateResult = update(USERS_TABLE, $valuesForUpdate, ["login" => $initialLogin]);

    if ($updateResult) {     
    
      $login = !empty($valuesForUpdate['login'])
        ? $login = $valuesForUpdate['login']
        : $initialLogin;

      define("SELECT_ONE", true);
      $updatedUser = select(USERS_TABLE, ['login' => $login], SELECT_ONE);
      /*
        Если авторизованный пользователь изменяет свой профиль,
        то обновляем его данные в сессии
      */
      if ($initialLogin == $_SESSION['user']['login']) {
        $_SESSION['user'] = $updatedUser; 
      }
      /*
        Если неверифицированный пользователь обновил профиль, то он
        обновил почту для верификации. Значит нужно отправить повторное
        письмо
      */
      if ($updatedUser['isVerified'] == 0 && sendVerificationMail($updatedUser)) {
        return "
          Вам отправлено новое письмо верификации на обновленный 
          адрес электронной почты. После подтверждения вы сможете
          <a href=\"/auth/\">
            Войти в аккаунт
          </a>";
      }

      return "Вы успешно обновили данные. 
        <a href=\"/cabinet/index.php?login=".$updatedUser['login']."\">
          Вернуться в личный кабинет
        </a>
      ";
    } else {
      return "Ошибка при обновлении данных";
    }
  }
?>