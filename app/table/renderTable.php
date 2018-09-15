<?php
  require_once $_SESSION['root']."/app/table/renderElementsGroup.php";
  
  function renderTable($headers, $trs, $markButtons = []) {
    $thead = renderElementsGroup("thead", "th", $headers);    
    $tbody = renderElementsGroup("tbody", "tr", $trs);
    $table = "
      <table class=\"table table-hover\">".
        $thead.
        $tbody."
      </table>
    ";
    if (!empty($markButtons)) {
      $markButtonsStr = "";
      foreach ($markButtons as $button) {
        $markButtonsStr .= "<p>".$button."</p>";
      }
      return "
        <form action=\"\" method=\"post\">
          ".$table.
          $markButtonsStr."
        </form>
      ";
    } else {
      return $table;
    }
  }
?>