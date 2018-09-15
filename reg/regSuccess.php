<?php
  session_start();
  require_once $_SESSION['root']."/app/renderPage.php";

  if (isset($_GET['login']) && isset($_GET['email'])) {
    $regSuccessPageContent = renderRegSuccess($_GET['login'], $_GET['email']);
    define("PAGE_TITLE_AND_HEADER", "Успех!");
    echo renderPage($regSuccessPageContent, PAGE_TITLE_AND_HEADER, PAGE_TITLE_AND_HEADER);
  }

  function renderRegSuccess($login, $email) {
    return "
      <p>Вы успешно зарегистрировали аккаунт ".$login."</p>
      <p> 
        На вашу почту ".$email."
        было отправлено письмо для подтверждения данных аккаунта
      </p>
      <p>После верификации вы сможете
        <a href=\"/auth/\"> войти в аккаунт</a>
      </p>
      <p>
        <a href=\"/verification/verificationHelp.php?login=".$login."\">
          Отправить повторное письмо
        </a>
      </p>
    ";
  }
?>