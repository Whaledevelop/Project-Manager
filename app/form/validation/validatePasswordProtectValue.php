<?php
  function validatePasswordProtectValue($enteredPassword, $actualPassword, $salt) {
    if (!empty($enteredPassword)) {
      $saltedPassword = md5($enteredPassword.$salt);
      if ($saltedPassword == $actualPassword) {
        return "correct";
      } else {
        return "Неправильный пароль";
      }
    }
  }
?>