<?php
  session_start();
  require_once $_SESSION['root']."/app/renderPage.php";

  require_once $_SESSION['root']."/verification/sendVerificationMail.php";

  require_once $_SESSION['root']."/sql/select.php";

  if (!empty($_GET['login'])) {
    define("USERS_TABLE", "users");
    define("SELECT_ONE", true);
    $user = select(USERS_TABLE, ['login' => $_GET['login']], SELECT_ONE);
    
    if ($user['isVerified'] == 0) {

      $changeMailHref = "/profile/edit/index.php?login=".
        $user['login']."&inputs[]=email
      ";
      $changeMailLink = "
        <a href=\"".$changeMailHref."\">
          изменить адрес электронной почты
        </a>
      ";

      if (sendVerificationMail($user)) {
        $verificationHelpContent = "
          <p>
            На вашу почту ".$user['email']." было отправлено 
            повторное письмо верификации
          </p>
          <p>Если вы не получили письмо, вы можете".$changeMailLink."</p>
        ";
      } else {
        $verificationHelpContent = "
          <p>Ошибка в доставке письма</p>
          <p>Попопробуйте ".$changeMailLink."</p>
        ";
      }
    } else {
      $verificationHelpContent = "
        <p>Аккаунт верифицирован, попробуйте 
          <a href=\"../auth/index.php\">авторизоваться еще раз</a>
        </p>
      ";
    }
  } else {
    $verificationHelpContent = "Не указан логин пользователя";
  }
  define("PAGE_TITLE", "Помощь в верификации");
  echo renderPage($verificationHelpContent, PAGE_TITLE);
?>