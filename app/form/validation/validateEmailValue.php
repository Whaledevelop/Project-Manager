<?php
  function validateEmailValue($email) {
    if (!empty($email)) {
      $emailPattern = "#^ [\w.-]+ @ \w+ \. [a-z]{1,3} #ixs";
      $isEmailCorrect = preg_match($emailPattern, trim($email));
      return $isEmailCorrect
        ? "correct" 
        : "Введите адрес электронной почты формата admin@yandex.ru";
    } else {
      return "Введите адрес электронной почты";
    }
  }
?>