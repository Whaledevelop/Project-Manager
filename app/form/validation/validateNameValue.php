<?php
  function validateNameValue($name) {
    if (!empty($name)) {
      $namePattern = "#^ [a-zа-яё\s]+ $#ixu";
      $isNameCorrect = preg_match($namePattern, trim($name));
      return $isNameCorrect
        ? "correct" 
        : "Имя не должно содержать цифр или символов";
    } else {
      return "Введите имя";
    }
  }
?>