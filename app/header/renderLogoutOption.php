<?php
  function renderLogoutOption($cabinetFolderPath) {
    return "
      <ul class=\"nav nav-pills headerNavBar\">
        <li class=\"nav-item\">
          <p class=\"nav-link disabled\">
            <a href=\"".$cabinetFolderPath."/logout.php\">
              Выйти из аккаунта
            </a>
          </p>
        </li>
        <li class=\"nav-item\">
          <a href=\"".$cabinetFolderPath."/logout.php\">
            <i class=\"fas fa-door-open\"></i>
          </a>
        </li>
      </ul>
    ";
  }
?>