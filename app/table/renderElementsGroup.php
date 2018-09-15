<?php
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