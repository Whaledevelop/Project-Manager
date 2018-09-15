<?php
  session_start();
  require_once $_SESSION['root']."/app/renderPage.php";

  require_once $_SESSION['root']."/profile/renderAuthProfileActions.php";
  require_once $_SESSION['root']."/profile/renderProfile.php";

  require_once $_SESSION['root']."/sql/select.php";  

  if (isset($_GET['login'])) {    
    $profileShownProps = ["name" => "Имя", "email" => "Email"];
    
    session_start();
    if ($_GET['login'] == $_SESSION['user']['login']) {
      $profile = $_SESSION['user'];
      $profileShownProps["registration_time"] = "Время регистрации";
      $profileShownProps["last_update"] = "Время последнего изменения профиля";
      $profilePageContent = renderProfile($profile, $profileShownProps).
        renderAuthProfileActions($profile['login']);
    } else {
      define("USERS_TABLE", "users");
      define("SELECT_ONE", true);
      $profile = select(USERS_TABLE, ['login' => $_GET['login']], SELECT_ONE);
      
      $profilePageContent = !empty($profile)
        ? renderProfile($profile, $profileShownProps)
        : "<p>Указанного пользователя нет в базе данных</p>";
    }
     
    define("PAGE_TITLE_AND_HEADER", "Профиль ".$profile['login']);
  } else {
    $profilePageContent = "<p>Не указан логин пользователя</p>";
  }
  echo renderPage($profilePageContent, PAGE_TITLE_AND_HEADER, PAGE_TITLE_AND_HEADER);
?>