<?php
  require_once __DIR__."/renderElementsGroup.php";
  
  function renderTable($headers, $trs, $markButtons = []) {
    if (!empty($trs)) {
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
    } else {
      return "<p>Пусто</p>";
    }
  }
?>