<?php
  function renderHeaderAuthProfileOptions($cabinetFolderPath) {
    $messagesFolderPath = $cabinetFolderPath."/messages";
    $authProfileOptionsIcons = [
      "<a href=\"".$cabinetFolderPath."/index.php\"
        <i class=\"fas fa-user-circle\"></i>
      </a>",
      "<a href=\"".$messagesFolderPath."/index.php\"
        <i class=\"fas fa-envelope-square\"></i>
      </a>",
      "<a href=\"".$messagesFolderPath."/writeMessage.php\"
        <i class=\"fas fa-pen-square\"></i>
      </a>",
      "<a href=\"".$cabinetFolderPath."/settings.php\"
        <i class=\"fas fa-cog\"></i>
      </a>"
    ];
    $optionsArray = array_map(function($icon) {
      return "<li class=\"nav-item\">".$icon."</li>";
    }, $authProfileOptionsIcons); 
    return implode("", $optionsArray);
  }
?>