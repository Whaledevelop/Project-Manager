<?php
  function renderAuthForm($authDataStatus) {
    return "
      <form action=\"\" method=\"post\">
        <div class='form-group'>
          <label>Логин : </label>
          <input 
            type=\"text\" name = \"login\"
            class=\"form-control col-lg-4\"
            value = ".(isset($_REQUEST['login']) ? $_REQUEST['login'] : "").
          "> 
        </div>
        <div class='form-group'>
          <label>Пароль : </label>
          <input 
            type=\"password\" name = \"password\" 
            class=\"form-control col-lg-4\"
          > 
        </div>
        <p>
          Запомнить меня : 
          <input 
            type=\"checkbox\" name=\"remember\"
            ".($_REQUEST['remember'] == "on" ? "checked" : "").
          ">
        </p>
        <button type=\"submit\" class=\"btn btn-primary\">Авторизоваться</button>
        <p>".$authDataStatus."</p>
      </form>
    ";
  }
?>