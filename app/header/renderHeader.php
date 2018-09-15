<?php
  require_once $_SESSION['root']."/app/header/renderHeaderAuthProfileOptions.php";
  require_once $_SESSION['root']."/app/header/renderLogoutOption.php";

  function renderHeader() {
    session_start();
    if (!empty($_SESSION['user'])) {
      $cabinetFolderPath = $_SESSION['rootHref']."/cabinet";
      $enteredAsInfo = "
        Вы вошли как
        <a href=\"".$cabinetFolderPath."/index.php\">
          ".$_SESSION['user']['login']."  
        </a> 
      ";
      $optionsString = renderHeaderAuthProfileOptions($cabinetFolderPath);
      $logoutOptionString = renderLogoutOption($cabinetFolderPath);
    } else {
      $enteredAsInfo = "Вы не авторизованы";
    }
    return "
      <div class=\"container-fluid headerNavBarContainer\">
        <div class=\"row\">
          <div  class=\"col-lg-9\">
            <ul class=\"nav nav-pills headerNavBar\">
              <li class=\"nav-item\">
                <a href=\"".$_SESSION['rootHref']."/index.php\">
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