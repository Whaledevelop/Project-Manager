<?php
  function validateThemeValue($theme) {
    if (!empty($theme)) {
      return "correct";
    } else {
      return "Введите тему сообщения";
    }
  }
?>