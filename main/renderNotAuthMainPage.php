<?php
  function renderNotAuthMainPage() {
    return "
      <p>Вы не можете смотреть контент сайта, потому что вы не авторизованы</p>
      <p><a href=\"/auth/\">Авторизоваться</a></p>
      <p><a href=\"/reg/\">Зарегистрироваться</a></p>
    ";
  }
?>