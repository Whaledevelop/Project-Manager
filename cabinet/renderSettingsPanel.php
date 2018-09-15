<?php
  function renderSettingsPanel($userLogin) {
    $authProfileHref = "../profile/index.php?login=".$userLogin;

    $editHref = function($inputs) use ($userLogin) {
      $inputsParams = "&inputs[]=".implode("&inputs[]=", $inputs);
      return "../profile/edit/index.php?login="
        .$userLogin.$inputsParams;
    };

    return "
      <div class = \"col-lg-6 pagePanel\">
        <h5 class=\"pageSubheader\">Настройки аккаунта</h5>
        <ul>
          <li>
            <a href=\"".$authProfileHref."\">Мой профиль</a>
          </li>
          <li>
            <a href=\"".$editHref(['name', "email"])."\">Редактировать профиль</a>
          </li>
          <li>
            <a href=\"".$editHref(['login'])."\">Редактировать логин</a>
          </li>
          <li>
            <a href=\"".$editHref(['password'])."\">Редактировать пароль</a>
          <li>
            <a href=\"logout.php\">Выйти из аккаунта</a>
          </li>
          </li>
          <li>
            <a href=\"deletePage.php\">Удалить аккаунт</a>
          </li>
        </ul>
      </div>
    ";
  }
?>