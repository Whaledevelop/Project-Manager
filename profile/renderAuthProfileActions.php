<?php
  function renderAuthProfileActions($login) {
    $editProfileHref = "/profile/edit/index.php?login=".$login.
      "&inputs[]=name&inputs[]=email";
    return "
      <p>Это ваш аккаунт. Вы можете :</p>
      <p>
        <a href=\"".$editProfileHref."\">
          Редактировать профиль
        </a>
      </p>
      <p>
        <a href=\"/cabinet/\">
          Войти в личный кабинет
        </a>
      </p>
    ";
  }
?>