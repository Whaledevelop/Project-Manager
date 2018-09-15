<?php
  function renderAuthProfileOptions() {
    $authProfileOptionsIcons = [
      "<a href=\"/cabinet/\"
        <i class=\"fas fa-user-circle\"></i>
      </a>",
      "<a href=\"/cabinet/messages/index.php\"
        <i class=\"fas fa-envelope-square\"></i>
      </a>",
      "<a href=\"/cabinet/messages/writeMessage.php\"
        <i class=\"fas fa-pen-square\"></i>
      </a>",
      "<a href=\"/cabinet/settings.php\"
        <i class=\"fas fa-cog\"></i>
      </a>"
    ];
    $optionsArray = array_map(function($icon) {
      return "<li class=\"nav-item\">".$icon."</li>";
    }, $authProfileOptionsIcons); 
    return implode("", $optionsArray);
  }
?>