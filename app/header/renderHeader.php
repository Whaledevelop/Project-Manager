<?php
  define("HEADER_PATH", $_SESSION['root']."/app/header");
  require_once HEADER_PATH."/renderAuthProfileOptions.php";
  require_once HEADER_PATH."/renderLogoutOption.php";

  function renderHeader() {
    session_start();
    if (!empty($_SESSION['user'])) {
      $enteredAsInfo = "
        Вы вошли как
        <a href=\"/cabinet\">
          ".$_SESSION['user']['login']."  
        </a> 
      ";
      $optionsString = renderAuthProfileOptions();
      $logoutOptionString = renderLogoutOption();
    } else {
      $enteredAsInfo = "Вы не авторизованы";
    }
    return "
      <div class=\"container-fluid headerNavBarContainer\">
        <div class=\"row\">
          <div  class=\"col-lg-9\">
            <ul class=\"nav nav-pills headerNavBar\">
              <li class=\"nav-item\">
                <a href=\"/\">
                  <i class=\"fas fa-home\"></i>
                </a>
              </li>
              <li class=\"nav-item\">
                <p class = \"nav-link disabled\">".
                  $enteredAsInfo."
                </p>
              </li>".
              (!empty($optionsString) ? $optionsString : "")."
            </ul>
          </div>
          <div class=\"col-lg-3\">".
            (!empty($logoutOptionString) ? $logoutOptionString : "")."
          </div>
        </div>
      </div>
    ";
  }
?>