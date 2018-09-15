<?php
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

  function renderElementsGroup($outElem, $inElem, $labels) {
    if (!empty($labels)) {
      $string = "<".$outElem.">";
      foreach ($labels as $label) {
        $string .= "<".$inElem.">".$label."</".$inElem.">";
      }
      $string .= "</".$outElem.">";
      return $string;
    } else {
      return "";
    }
  }
?>