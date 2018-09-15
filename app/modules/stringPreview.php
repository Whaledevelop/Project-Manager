<?php
  function stringPreview($string, $length) {
    return mb_strlen($string) > $length 
      ? substr($string, 0, $length)."..."
      : $string;
  }
?>