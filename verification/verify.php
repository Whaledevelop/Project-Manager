<?php
  session_start();
  require_once $_SESSION['root']."/app/renderPage.php";

  require_once $_SESSION['root']."/sql/select.php";
  require_once $_SESSION['root']."/sql/update.php";
  
  if (isset($_GET['verification_code']) && isset($_GET['login'])) {

    $login = $_GET['login'];
    define("USERS_TABLE", "users");
    define("SELECT_ONE", true);
    $selectConditions = ["login" => $login, "verification_code" => $_GET['verification_code']];
    $user = select(USERS_TABLE, $selectConditions, SELECT_ONE);

    if (!empty($user)) {

      $updateData = ["isVerified" => 1];
      $updateUserConditions = ["login" => $login];
      if (update(USERS_TABLE, $updateData, $updateUserConditions)) {
        
        $verifyPageContent = "
          <p>
            Вы успешно верифицировали свой профиль. Теперь вы можете
            <a href=\"/auth/index.php?login=".$login."\">
              войти в аккаунт
            </a>
          </p> 
        ";
      }
    }
  } else {
    $verifyPageContent = "Неправильный код верификации или логин";
  }
  define("PAGE_TITLE_AND_HEADER", "Страница верификации");
  echo renderPage($verifyPageContent, PAGE_TITLE_AND_HEADER, PAGE_TITLE_AND_HEADER);
?>
             