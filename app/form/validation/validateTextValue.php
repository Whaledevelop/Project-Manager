<?php
  function validateTextValue($text) {
    if (!empty($text)) {
      return "correct";
    } else {
      return "Введите текст сообщения";
    }
  }
?>