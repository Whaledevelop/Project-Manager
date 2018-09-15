<?php
  function renderNotAuthMainPage() {
    return "
      <p>Вы не можете смотреть контент сайта, потому что вы не авторизованы</p>
      <p><a href=\"".$_SESSION['rootHref']."/auth/\">Авторизоваться</a></p>
      <p><a href=\"".$_SESSION['rootHref']."/reg/\">Зарегистрироваться</a></p>
    ";
  }
?>