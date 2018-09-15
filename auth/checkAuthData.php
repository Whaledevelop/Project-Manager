<?php
  /* 
    Функция проверяет данные, введенные при авторизации. 
    Проверяет соответствие паролей и верифицированность аккаунта.
  */
  function checkAuthData($user) {
    if (!empty($user)) {
      if ($user['isVerified']) {
        $saltedPassword = md5($_REQUEST['password'].$user['salt']);
        if ($saltedPassword == $user['password']) {
          return "correct";
        }
      } else {
        $helpHref = "/verification/verificationHelp.php?login=".$user['login'];
        return "
          <p>Аккаунт не верифицирован. 
            <a href=\"".$helpHref."\">
              Проблемы с верификацией?
            </a>
          </p>
        ";
      }
    } 
    return "Неправильная пара логин-пароль";
  } 
?>