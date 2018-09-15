<?php
  function renderAuthForm($authDataStatus) {
    return "
      <form action=\"\" method=\"post\">
        <div class='form-group'>
          <label for=\"loginInput\">Логин : </label>
          <input 
            type=\"text\" name = \"login\"
            class=\"form-control col-lg-4\" id=\"loginInput\"
            value = ".(isset($_REQUEST['login']) ? $_REQUEST['login'] : "")."> 
        </div>
        <div class='form-group'>
          <label for=\"passInput\">Пароль : </label>
          <input 
            type=\"password\" name = \"password\" 
            class=\"form-control col-lg-4\" id=\"passInput\"> 
        </div>
        <p>Запомнить меня : <input 
          type=\"checkbox\" name=\"remember\"
          ".($_REQUEST['remember'] == "on" ? "checked" : "").">
        </p>
        <button type=\"submit\" class=\"btn btn-primary\">Авторизоваться</button>
        <p>".$authDataStatus."</p>
      </form>
    ";
  }
?>