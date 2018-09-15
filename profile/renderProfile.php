<?php
  function renderProfile($profile, $shownProps) {
    $shownPropsString = "";
    foreach ($shownProps as $key => $label) {
      $value = preg_match("#^время #iuxs", $label)
        ? date("H:i:s - d.m.Y", strtotime($profile[$key]))
        : $profile[$key];
  
      $shownPropsString .= "<li>".$label." : ".$value."</li>";
    }
    return "
      <ul>
        ".$shownPropsString."
      </ul>
    ";
  }
?>