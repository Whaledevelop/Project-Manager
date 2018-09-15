<?php
  function validatePasswordValue($enteredPassword, $oldPassword, $salt) {
    if (!empty($enteredPassword)) {

      if (!empty($oldPassword) && !empty($salt)) {
        $saltedEnteredPassword = md5($enteredPassword.$salt);
        if ($oldPassword == $saltedEnteredPassword) {
          return "Выберите новый пароль";
        } 
      } 
      $length = strlen(trim($enteredPassword));
      $isPassCorrect =  $length >= 3 && $length <= 10;
      return $isPassCorrect
        ? "correct" 
        : "Пароль должен иметь больше 3-ех символов и меньше 10-ти";
    } else return "Введите пароль";
  }
?>